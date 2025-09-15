<?php

function send_message($name, $email, $message)
{
    $query = "INSERT INTO contact_messages (`name`, `email`, `message`) VALUES (?, ?, ?)";
    try {
        $ok = db_execute($query, [$name, $email, $message]);
        if (!$ok) {
            app_log("[send_message] La requête à échoué.");
            throw new Exception("La requête à échoué.");
        }

        return true;
    } catch (Throwable $e) {
        app_log("[send_message] " . $e->getMessage());
        return false;
    }
}