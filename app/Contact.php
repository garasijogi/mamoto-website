<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	public function getContacts()
	{
		$contacts = $this->get()->toArray();		
		$contact_instagram = array(); $contacts_processed = array(); $x = 0;
		foreach ($contacts as $v) {
			if($v['name'] == 'instagram'){
				$contact_instagram = $this->processContact($v);
			} else {
				$contacts_processed[$x] = $this->processContact($v);
				$x++;
			}
		}

		return array(
			'contact_instagram' => $contact_instagram,
			'contacts_processed' => $contacts_processed
		);
	}

	private function processContact($v)
	{
		return array(
			'text' => $v['text'],
			'logo' => $v['logo'],
			'contact' => $v['contact'],
			'link' => $v['link'] . $v['contact']
		);
	}
}
