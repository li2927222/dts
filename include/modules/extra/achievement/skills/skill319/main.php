<?php

namespace skill319
{
	function init() 
	{
		define('MOD_SKILL319_INFO','achievement;daily;');
		define('MOD_SKILL319_ACHIEVEMENT_ID','19');
	}
	
	function acquire319(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_setvalue(319,'cnt','0',$pa);
	}
	
	function lost319(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys'));
		if ((!in_array($gametype,$ach_ignore_mode))&&(!\skillbase\skill_query(319,$pa))) //也可以做一些只有房间模式有效的成就
			\skillbase\skill_acquire(319,$pa);
		$chprocess($pa);
	}
	
	function skill_onsave_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function finalize319(&$pa, $data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='VWXYZ') return 'VWXYZ';
		if ($data=='') return 'VWXYZ';
		if ($data=='')					
			$x=0;						
		else	$x=base64_decode_number($data);		
		$ox=$x;
		$x+=\skillbase\skill_getvalue(319,'cnt',$pa);		
		$x=min($x,(1<<30)-1);
		
		if (($ox<1)&&($x>=15)){
			\cardbase\get_qiegao(485,$pa);
			\cardbase\get_card(12,$pa);
		}
		
		return base64_encode_number($x,5);		
	}

	function itemmix_success()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player','logger','map'));
		if (strlen($itmk0)>=4){//其实这很不严谨！
			$x=(int)\skillbase\skill_getvalue(319,'cnt');
			$x++;
			\skillbase\skill_setvalue(319,'cnt',$x);
		}
		$chprocess();	
	}
	
	function show_achievement319($data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')
			$p319=0;
		else	$p319=base64_decode_number($data);	
		$c319=0;
		if ($p319>=15){
			$c319=999;
		}
		include template('MOD_SKILL319_DESC');
	}
}

?>