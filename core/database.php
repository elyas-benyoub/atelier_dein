<?php
// Fonctions de base de données + journalisation simple

/**
 * Écrit une ligne dans storage/logs/db.log (créé le dossier si besoin)
 */
function db_log(string $msg): void {
    $file = __DIR__ . '/../storage/logs/db.log';   // core/ → ../storage/logs/
    $dir  = dirname($file);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true); 
    }

    $date = date('d/m/Y H:i:s'); // format FR
    error_log("[$date] $msg\n", 3, $file);
}

/**
 * Établit une connexion à la base de données
 */
function db_connect() {
    static $pdo = null;

    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            db_log("DB CONNECT OK host=" . DB_HOST . " db=" . DB_NAME . " user=" . DB_USER);
        } catch (PDOException $e) {
            // On logue l’erreur (mot de passe faux, etc.)
            db_log("DB CONNECT FAIL: " . $e->getMessage());
            // Message utilisateur générique (pas d’infos sensibles)
            die("Erreur de connexion à la base de données.");
        }
    }

    return $pdo;
}

/**
 * Exécute une requête SELECT
 */
function db_select($query, $params = []) {
    try {
        $pdo = db_connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        db_log("SELECT OK: $query | params=" . json_encode($params)); // décommente si tu veux tracer
        return $stmt->fetchAll();
    } catch (Throwable $e) {
        db_log("SELECT FAIL: $query | params=" . json_encode($params) . " | " . $e->getMessage());
        throw $e; // en dev : remonter l'erreur; sinon, retourne [] si tu préfères
        // return [];
    }
}

/**
 * Exécute une requête SELECT pour un seul résultat
 */
function db_select_one($query, $params = []) {
    try {
        $pdo = db_connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        // db_log("SELECT ONE OK: $query | params=" . json_encode($params));
        return $stmt->fetch();
    } catch (Throwable $e) {
        db_log("SELECT ONE FAIL: $query | params=" . json_encode($params) . " | " . $e->getMessage());
        throw $e;
        // return null;
    }
}

/**
 * Exécute une requête INSERT, UPDATE ou DELETE
 */
function db_execute($query, $params = []) {
    try {
        $pdo = db_connect();
        $stmt = $pdo->prepare($query);
        $ok = $stmt->execute($params);
        // db_log("EXECUTE OK: $query | params=" . json_encode($params));
        return $ok;
    } catch (Throwable $e) {
        db_log("EXECUTE FAIL: $query | params=" . json_encode($params) . " | " . $e->getMessage());
        throw $e;
        // return false;
    }
}

/**
 * Retourne l'ID du dernier enregistrement inséré
 */
function db_last_insert_id() {
    $pdo = db_connect();
    return $pdo->lastInsertId();
}

/**
 * Transaction helpers
 */
function db_begin_transaction() {
    $pdo = db_connect();
    return $pdo->beginTransaction();
}

function db_commit() {
    $pdo = db_connect();
    return $pdo->commit();
}

function db_rollback() {
    $pdo = db_connect();
    return $pdo->rollBack();
}