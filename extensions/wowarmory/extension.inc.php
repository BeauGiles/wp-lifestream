<?php
class LifeStream_WoWArmoryFeed extends LifeStream_Feed
{
	const ID			= 'wowarmory';
	const NAME			= 'WoW Armory';
	const URL			= 'http://www.wowarmory.com/';
	const LABEL			= 'Lifestream_MessageLabel';
	const DESCRIPTION	= 'Display your character\'s Activity feed. (Achievement, Boss Kills, Loot)';
	const AUTHOR		= 'gizzmo';
	
	function __toString()
	{
		return $this->get_option('character').'@'.$this->get_option('realm');
	}
	
	function get_options()
	{
		return array(
			'character'	=> array($this->lifestream->__('Character:'), TRUE, '',''),
			'realm'		=> array($this->lifestream->__('Realm:'), TRUE, '','')
		);
	}
	
	function get_public_url()
	{
		return 'http://www.wowarmory.com/character-feed.xml?r='.urlencode($this->get_option('realm')).'&cn='.urlencode($this->get_option('character'));
	}
	
	function get_url()
	{
		return 'http://www.wowarmory.com/character-feed.atom?r='.urlencode($this->get_option('realm')).'&cn='.urlencode($this->get_option('character'));
	}
	
	function render_item($row, $item)
	{
		$item['title'] = strtolower( substr($item['title'],0,1) ) . substr($item['title'],1);
	
		return $this->lifestream->get_anchor_html(
			ucfirst(htmlspecialchars($this->get_option('character'))),
			'http://www.wowarmory.com/character-sheet.xml?r='.$this->get_option('realm').'&cn='.$this->get_option('character')
		).' '.htmlspecialchars($item['title']);
	}
}

$lifestream->register_feed('LifeStream_WoWArmoryFeed');