<?php

$cabecalho = [
  'alg' => 'HS256',
  'typ' => 'JWTProvider'
];

$corpo =[
  'name' => 'Diego Luiz',
  'email' => 'diegoluizcsti@gmail.com',
  'role' => 'admin'
];

$cabecalho = json_encode($cabecalho);
$corpo = json_encode($corpo);

echo "Cabealho do JSON: $cabecalho";
echo "\n";
echo "Corpo da informação JSON: $corpo";
echo "\n";

$cabecalho = base64_encode($cabecalho);
$corpo = base64_encode($corpo);

echo "Cabealho do Base64: $cabecalho";
echo "\n";
echo "Corpo da informação Base64: $corpo";
echo "\n";
echo "\n";
echo "$cabecalho.$corpo";
echo "\n\n";

$chave = "ksn3RN8YN8RYBQRB9R38Y2R9H38RBQH";

$assinatura = hash_hmac('sha256',  "$cabecalho.$corpo", $chave, true);
echo "Assinatura RaW: $assinatura";
echo "\n\n";
$assinatura = base64_encode($assinatura);
echo "ASSINATURA emBase64: $assinatura";
echo "\n\n";

echo "JWTProvider: $cabecalho.$corpo.$assinatura";
echo "\n\n";