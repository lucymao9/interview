<?php
namespace App\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequest
{
    protected Request $request;
    protected $errorMessage=[];
    // protected Request $request;
    public function __construct(protected RequestStack $requestStack,protected ValidatorInterface $validator)
    {
        $this->request=$this->requestStack->getCurrentRequest();
        $this->populate();

        if ($this->autoValidateRequest()) {
            $this->validate();
        }  
    }



    public function setRequest(){
        $this->request = $request;
        $this->populate();

        if ($this->autoValidateRequest()) {
            $this->validate();
        }

        return $this;
    }

    public function getRequest(){
        return $this->request;
    }
    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function validate()
    {
        $errors = $this->validator->validate($this);
        $messages = ['message' => 'validation_failed', 'errors' => []];
        foreach ($errors as $message) {
            $messages['errors'][] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }
        if (count($messages['errors']) > 0) {
            $this->errorMessage = new JsonResponse($messages, 201);
        }
    }


    protected function populate(): void
    {
        
        foreach ($this->request->query->all() as $property => $value) {
            if(isset($this->preHandle()[$property])){
                $callback=$this->preHandle()[$property];
                $this->request->query->all()[$property] = $value = $callback($value);
            }
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
        foreach ($this->request->request->all() as $property => $value) {
            if(isset($this->preHandle()[$property])){
                $callback=$this->preHandle()[$property];
                $this->request->request->all()[$property] = $value = $callback($value);
            }
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
        //other parameters such as files,cookies...
        //code here...
    }

    // set false in child class if not valid
    protected function autoValidateRequest(): bool
    {
        return true;
    }

    //preprocessing params
    public function preHandle(): array
    {
        return [];
    }
}