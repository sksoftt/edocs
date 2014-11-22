<?php

/*
 * This View gets messages and print them
 */

if (is_array($messages))
{
    foreach ($messages as $message)
    {
        print $message;
    }
    return;
}

print $messages;
return;