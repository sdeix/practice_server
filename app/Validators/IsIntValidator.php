<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class IsIntValidator extends AbstractValidator
{

   protected string $message = 'Field :field is required';

   public function rule(): bool
   {
       return is_int($this->value);
   }
}
