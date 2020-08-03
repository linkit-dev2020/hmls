<?php
use Friends\Chandler\ChandlerJokes;
class AbdussalamKernal
{
    public function __construct()
    {
        $this->wakeUp();
        $this->loadSarcasmSoftware();
        $this->curesSlemanKhadoor();
        while(!MID_NIGHT)
        {
            $jokeTypes=['Silly','Dirty'];
            $r=random_int(0,1);
            $this->tellJokes($jokeTypes[$r]);
        }
    }
    public function askHimSomething($question)
    {
        return "Fuck You!";
    }
    public function wakeUp()
    {
        return "اجري بسليمان خضور";
    }
    const MID_NIGHT="12:00pm";
    public function loadSarcasmSoftware()
    {
        return new ChandlerJokes();
    }
}
