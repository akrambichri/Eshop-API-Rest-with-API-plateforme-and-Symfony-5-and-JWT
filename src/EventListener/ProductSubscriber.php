<?php


namespace App\EventListener;


use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * Class UserSubscriber
 * A l'inscription d'un utilisateur,
 * on lui envoi un email.
 * @package App\EventListener
 */
class ProductSubscriber implements EventSubscriber
{

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->sendnotificationEmail($args);
    }

    private function sendnotificationEmail(LifecycleEventArgs $args)
    {
        $product = $args->getObject();

        // if this subscriber only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$product instanceof Product) {
            return;
        }

        # Envoi d'un Email
        $email = (new Email())
            ->from('admin@eshop.com')
            ->to('marketing@eshop.com')
            ->subject('New Product has been added !')
            ->html('<p>' . $product->getName() . ', Has been added to eShop market !</p>');

        $this->mailer->send($email);
    }
}
