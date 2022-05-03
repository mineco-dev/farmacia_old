<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>


<?php 

    $xmlstg = '<?xml version="1.0"?'; 
    $xmlstg .= '><candy><anatomically_shaped><head_to_bite_off>chocolate bunnies</head_to_bite_off><headless>gummi worms</headless></anatomically_shaped></candy>'; 
        
    
	
	
	
    $dom = domxml_open_mem($xmlstg); 
    $root = $dom->document_element(); 
    $root->name = '$candy'; 
    function parse_node($node) { 
        global $candy; 
        if ($node->has_child_nodes()) { 
            foreach($node->child_nodes() as $n) { 
                if ($n->node_name() == '#text') { 
                    eval("$node->name=\"" . $n->node_value() . "\";"); 
                } 
                else { 
                    $n->name = $node->name . '->' . $n->node_name(); 
                    parse_node($n); 
                } 
            } 
        } 
    } 

    parse_node($root); 
    echo $candy->anatomically_shaped->head_to_bite_off; 
// echos "chocolate bunnies" 

?> 

</body>
</html>
