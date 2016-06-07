<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsAdminName extends Constraint
{
    public $message = 'The  "%admin_name%"  name  is  only  allowed  to  be  used  with  the  %admin_email%';
}