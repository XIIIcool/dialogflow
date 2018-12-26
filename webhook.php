<?
require_once __DIR__ . '/vendor/autoload.php';
	
use Dialogflow\WebhookClient;
use Dialogflow\Action\Responses\SimpleResponse;
Use Dialogflow\RichMessage\Payload;

$agent = new WebhookClient(json_decode(file_get_contents('php://input'),true));

$mes = $agent->getRequestSource($agent);

$telegramButton = [
        'expectUserResponse' => false,
	    "text"=> "Привет из Telegram Вот Кнопки!",
	    "reply_markup"=> [
	      	"inline_keyboard"=> [
	        	[["text"=> "Red", "callback_data"=> "Red"]],
	        	[["text"=> "Red", "callback_data"=> "Red"],["text"=> "Red", "callback_data"=> "Red"],["text"=> "Red", "callback_data"=> "Red"]]
	    	]
	    ]

    ];
	
$viberButton = 	[
		"type"=> "picture",
		"text"=> "New Year picture",
		"media"=> "https://secure.gravatar.com/avatar/dc6a1427cdf0ac31bc084af8ef212c54?s=96&r=g"

	];	  			
		

$button = '';

if($mes == 'telegram') $button = $telegramButton;
if($mes == 'viber') $button = $viberButton;

$agent->reply(\Dialogflow\RichMessage\Payload::create($button));


header('Content-type: application/json');

echo json_encode($agent->render());

error_log(var_export($agent,true).PHP_EOL,3,'agent');
error_log(json_encode($agent->render()).PHP_EOL,3,'agent-response');
error_log(var_export($mes,true).PHP_EOL,3,'agent-mes');
error_log(var_export($viberButton,true).PHP_EOL,3,'v');


?>

