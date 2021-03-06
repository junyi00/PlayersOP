/* 
name=PlayersOP
description=Everyone who join is OP! 
version=1.2
author=Junyi00
class=PlayersOP
apiversion=9
*/

class PlayersOP implements Plugin {
    private $api, $path;

    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }

    public function init() {
        $this->api->addHandler('player.spawn', array($this, 'OPPlayer'));
        $this->api->console->register('checkkop', 'Check if u are op!', array($this, 'CheckOp'));

    }

    public function __destruct() { } 

    public function OPPlayer($data, $event) {
        switch($event) {
    		case "player.spawn":
    	
    			$user = $data->username;
    			$this->api->ban->commandHandler("op", $user, "console", false);
    			$this->api->chat->sendTo(false,"You are op!",$data->iusername);
    			break;
    			
       	}
    	
    }
    
    public function CheckOp($cmd, $arg, $issuer) {
    	switch($cmd) {
    		case "checkkop":
    			$name = $arg[0];
    			if ($name === "") {
    				$name = $issuer;	
    			}	
    			
    			if ($this->api->ban->isOp($name) === true) {
    				$output .= "You are op!";	
    			}
    			else {
    				$output .= "You are not op!";
    			}
    			
    	}
    	
    	return $output;		
    	
    }
    
}
