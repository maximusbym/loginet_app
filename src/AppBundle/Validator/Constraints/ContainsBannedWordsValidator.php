<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsBannedWordsValidator extends ConstraintValidator
{
    protected $em;
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $em = $this->em;
        $bannedWords = $em->getRepository('AppBundle:BannedWord')->findAll();

        foreach( $bannedWords as $bannedWord ) {

            $word = $bannedWord->getWord();
            if (strpos($value, $word) !== false) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%banned_word%', $word)
                    ->addViolation();
            }
        }
    }

}