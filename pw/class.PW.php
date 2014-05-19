<?php
class PW {
    private $password_length = 4;
    private $letters = true;
    private $numbers = false;
    private $case_insensitive = false;
    private $special_chars = false;
    private $quantity = 1;

    private $passwords = array();

    public function generate()
    {
        for($password_index = 0; $password_index < $this->quantity; $password_index++)
        {
            $new_password = '';
            for($character = 0; $character < $this->password_length; $character++)
            {
                $possible_chars = range('a','z');

                if($this->numbers)
                    foreach(range(0,9) as $number)
                        $possible_chars[] = $number;

                if($this->case_insensitive)
                    foreach(range('A','Z') as $letter)
                        $possible_chars[] = $letter;

                if($this->special_chars)
                    foreach(array('!','@','#','$','%','^','&','*','-','_','+','=','?') as $char)
                        $possible_chars[] = $char;

                for($shuffle = 0; $shuffle < mt_rand(1,100); $shuffle++)
                    shuffle($possible_chars);

                $new_password .= $possible_chars[mt_rand(0,(count($possible_chars) - 1))];
            }
            $passwords = $this->get_passwords();
            $passwords[] = $new_password;
            $this->set_passwords($passwords);
        }
    }

    public function set_password_length($password_length)
    {
        if(is_numeric($password_length) && 4 <= $password_length && $password_length <= 64)
        {
            $this->password_length = $password_length;
        }
    }

    public function set_numbers($numbers)
    {
        $this->numbers = $numbers;
    }

    public function set_case_insensitive($case_insensitive)
    {
        $this->case_insensitive = $case_insensitive;
    }

    public function set_special_chars($special_chars)
    {
        $this->special_chars = $special_chars;
    }

    public function set_quantity($quantity)
    {
        if(is_numeric($quantity) && 1 <= $quantity && $quantity <= 10)
        {
            $this->quantity = $quantity;
        }
    }

    public function get_passwords()
    {
        return $this->passwords;
    }

    public function set_passwords(array $passwords)
    {
        $this->passwords = $passwords;
    }
}
