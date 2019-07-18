=== Contact Form 7 + Telegram ===
Contributors: hokku
Donate link: https://www.paypal.me/hokku
Tags: contact form telegram
Requires at least: 3.0
Tested up to: 5.0
Requires PHP: 5.4
Stable tag: trunc
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows to post CF7-messages to you through Telegram-bot. Just use shortcode [telegram] in your CF7-form.

== Description ==

This plugin allows to send Contact Form 7 messages to your Telegram-chat. For this you need to make several simple steps.

1. Create the Telegram-Bot and save the Bot-Token parameter on the settings page Contact Form 7 - CF7 Telegram.
2. Paste the shortcode <code>[telegram]</code> in your contact form template for activate sending to Telegaram.
3. Get your Chat ID and save this on the settings page Contact Form 7 - CF7 Telegram. You can see your Chat ID by typing anything to Telegram-Bot <code>@wpcf7Bot</code>.
4. Start chat with your bot, you created in first step. Use the same Telegram-account as the 3-rd step. Just click the START button.


This plugin uses [API Telegram](https://core.telegram.org/api "Telegram docs") and makes remote HTTP-requests to Telegram servers for sending your notifications.

== Frequently Asked Questions ==

= How to create the Telegram-Bot? =

It is very simple. Please, follow to  [official documentation](https://core.telegram.org/bots#3-how-do-i-create-a-bot "Telegram docs").

= What is Chat ID & how to get it? =

The Chat ID parameter is your Telegram-identifier. But this is not your phone number or Telegram-login (@xxxxxxxx). 
You can see your Chat ID by typing anything to Telegram-Bot <code>@wpcf7Bot</code>.