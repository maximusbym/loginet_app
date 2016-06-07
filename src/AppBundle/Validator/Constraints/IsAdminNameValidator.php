<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsAdminNameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $adminEmail = 'admin@admin.hu';
        $adminNick = 'admin';
        $currentEmail = $this->context->getObject()->getEmail();

        if ($value == $adminNick && $currentEmail != $adminEmail) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%name%', $adminNick)
                ->setParameter('%admin_email%', $adminEmail)
                ->addViolation();
        }
    }
}