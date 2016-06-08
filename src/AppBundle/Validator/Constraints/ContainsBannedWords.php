<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsBannedWords extends Constraint
{
    public $message = 'The comment contains a banned word: "%banned_word%"';

    public function validatedBy()
    {
        return 'alias_name';
    }
}