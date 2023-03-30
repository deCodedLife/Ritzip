<?php

/**
 * Инициализация библиотеки DocuSign
 */

use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Api\EnvelopesApi\ListStatusChangesOptions;
use DocuSign\eSign\Api\EnvelopesApi\ListDocumentsOptions;


/**
 * Получение настроек
 */
$settings = $API->DB->from( "settings" )
    ->limit( 1 )
    ->fetch();


/**
 * Подключение к DocuSign
 */
$configuration = new Configuration();
$docuSignApi = new ApiClient( $configuration );


/**
 * Получение токена DocuSign
 */

$privateKey = $settings[ "docusign_private_key" ];
$integration_key = $settings[ "docusign_private_key" ];
$impersonatedUserId = "df032d3c-80c9-4bec-aab1-8396cb2eecd4";
$scopes = "signature impersonation";

$docuSignApi->getOAuth()->setOAuthBasePath( "account-d.docusign.com" );

$authorizationResponse = $docuSignApi->requestJWTUserToken(
    $settings[ "integration_key" ],
    $settings[ "user_id" ],
    $settings[ "docusign_private_key" ],
    "signature impersonation", 60
);

if ( !$authorizationResponse ) $API->returnResponse( "Не удалось подключиться к DocuSign" );

$accessToken = $authorizationResponse[ 0 ][ "access_token" ];


/**
 * Получение ID аккаунта DocuSign
 */
$docuSignUserInfo = $docuSignApi->getUserInfo( $accessToken );
$docuSignAccountId = $docuSignUserInfo[ 0 ][ "accounts" ][ 0 ][ "account_id" ];


/**
 * Авторизация DocuSign
 */

$configuration->setHost( "https://" . $settings[ "api_url" ] );
$configuration->addDefaultHeader( "Authorization", "Bearer " . $accessToken );

$docuSignApi = new ApiClient( $configuration );
$docuSignApi = new DocuSign\eSign\Api\ConnectApi( $docuSignApi );


/**
 * Получение пользователей DocuSign
 */
$docuSignUsers = $docuSignApi->listUsers( $docuSignAccountId, 10379674 );

foreach ( $docuSignUsers as $docuSignUser ) {

    $API->returnResponse( $docuSignUser );

}