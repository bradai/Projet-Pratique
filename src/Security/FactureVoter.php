<?php


namespace App\Security;

use App\Entity\Facture;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class FactureVoter extends Voter
{

    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['edit', 'delete'])
            && $subject instanceof Facture;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'edit':
            case 'delete':
                return $this->canEditOrDelete($subject, $user);
        }

        return false;
    }

    private function canEditOrDelete(Facture $facture, User $user): bool
    {
        return $facture->getUser() === $user;
    }
}