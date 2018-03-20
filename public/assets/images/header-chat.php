<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Microinvest- credite, imprumuturi, credite timp de o ora</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=1042">
	<link type="text/css" href="<?php bloginfo('template_url');?>/css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.titlealert.js"></script>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<script type="text/javascript">
	$(document).ready(function()
	{
		$('.chat-box').animate({ scrollTop: $('.chat-box')[0].scrollHeight}, 0);
		
		$('.chat-form form button[type=submit]').click(function()
		{
			form = $(this).parents('form');
			button = $(this);
			event = this.name;
			form_data = $(this.form).serialize() + (event == 'refresh' ? '&refresh=1' : '');
			
			if (event == 'refresh') button.find('i').addClass('icon-spin');
			if (event == 'submit')
			{
				if (form.find('textarea[name=text]').val() == '') return false;
				button.find('i').addClass('icon-bounceoutup');
			}
			
			//nr of messages
			old_messages = $('.chat-box tr').length;
			
			$.post(this.form.action, form_data, function(data)
			{
				//nr of new messages
				new_messages = $(data).filter('.chat-container').find('.chat-box tr').length;
				
				if (!isNaN(new_messages))
				{
					$('.chat-box').empty().append($(data).filter('.chat-container').find('.chat-box table'));
					
					if (event == 'refresh' && new_messages > old_messages)
					{
						$.titleAlert('<?php _e('Aveți mesaje noi!');?>',
						{
							requireBlur:true,
							stopOnFocus:true,
							duration:300000,
							interval:1000
						});
					}
					
					if ($('.chat-box')[0].scrollHeight - $('.chat-box').height() - 100 < $('.chat-box')[0].scrollTop  || event == 'refresh') $('.chat-box').animate({ scrollTop: $('.chat-box')[0].scrollHeight}, 0);
				}
				
				if (event == 'refresh') button.find('i').removeClass('icon-spin');
				if (event == 'submit') button.find('i').removeClass('icon-bounceoutup');
				
            });
			
			if (event == 'submit') this.form.reset();
			
			return false;
		});
		
		setInterval(function()
		{
			$('.chat-form form button[name=refresh]').trigger('click');
		}, 30000);
	});
	</script>
</head>
<body>