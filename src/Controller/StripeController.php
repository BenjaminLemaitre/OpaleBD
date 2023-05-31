<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class StripeController extends AbstractController
{
    #[Route('/commande/create-session/{reference}', name: 'app_stripe_create_session')]
    public function index(EntityManagerInterface $entityManager, Cart $cart, $reference): Response
    {
        $product_for_stripe = [];
        $YOUR_DOMAIN = "http://149.202.139.179:8000";

        $order = $entityManager->getRepository(Order::class)->findOneByReference($reference);

        if (!$order) {
            $response = new JsonResponse(['error' => 'order']);
        }

        foreach ($order->getOrderDetails()->getValues() as $product) {
            $product_object = $entityManager->getRepository(Product::class)->findOneByName($product->getProduct());
            $product_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->getProduct(),
                        'images' => [$YOUR_DOMAIN."/uploads/".$product_object->getIllustration()],
                    ],
                    'unit_amount' => $product->getPrice(),
                ],
                'quantity' => $product->getQuantity(),
            ];
        }

        $product_for_stripe[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => intval($order->getCarrierPrice()*100),
                'product_data' => [
                    'name' => $order->getCarrierName(),
                    // Pour l'image, mettre une image pour collissimo ou autre
                    // 'images' => [$YOUR_DOMAIN],
                ],
            ],
            'quantity' => 1,
        ];


        Stripe::setApiKey('sk_test_51MWxETESg3tRriAXBJXcUqtzmQGAmQXPtOHwbJIDXgaIcXqxZUvGlOM8ZPv3gxHzNcuCdeImgQNKZV6uXxtlGn7K00ml0u3K7o');
            
            $checkout_session = Session::create([
                // customer_email: indique a stripe l'email de l'utilisateur sans que l'utilisateur entre de nouveau son mail pour le paiement
                'customer_email' => $this->getUser()->getEmail(),
                'payment_method_types' => ['card'],
                'line_items' => [
                    $product_for_stripe
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}',
                ]);

        $order->setStripeSessionId($checkout_session->id);
        $entityManager->flush();

        $response = new JsonResponse(['id' => $checkout_session->id]);
        return $response;
    }
}
