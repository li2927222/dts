<?php

namespace skill400
{
	$paneldesc=array('重击','重击1','重击2','重击3','重击4','烈击');
	$attgain=array(0,20,30,50,100,100);
	$procrate=array(0,20,25,30,35,75);

	function init() 
	{
		define('MOD_SKILL400_INFO','club;NPC;');
		eval(import_module('clubbase'));
		$clubskillname[400] = '重击';
	}
	
	function acquire400(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_setvalue(400,'lvl','0',$pa);
	}
	
	function lost400(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_delvalue(400,'lvl',$pa);
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function skill_onsave_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function check_unlocked400(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 1;
	}
	
	function check_skill400_proc(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('skill400','player','logger'));
		if (!\skillbase\skill_query(400, $pa) || !check_unlocked400($pa)) return Array();
		$l400=\skillbase\skill_getvalue(400,'lvl',$pa);
		if (rand(0,99)<$procrate[$l400])
		{
			if ($l400==5)
				$log.="<span class=\"yellow\">{$pa['name']}朝你打出了猛烈的一击！</span><br>";
			else  $log.="<span class=\"yellow\">{$pa['name']}朝你打出了重击！</span><br>";
			
			$dmggain = (100+$attgain[$l400])/100;
			return Array($dmggain);
		}
		return Array();
	}
	
	function get_physical_dmg_multiplier(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$r = check_skill400_proc($pa,$pd,$active);
		return array_merge($r,$chprocess($pa,$pd,$active));
	}
}

?>
