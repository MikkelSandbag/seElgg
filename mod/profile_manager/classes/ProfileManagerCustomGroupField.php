<?php
/**
 * ProfileManagerCustomGroupField
 *
 * @package ProfileManager
 *
 */
class ProfileManagerCustomGroupField extends ProfileManagerCustomField {
	const SUBTYPE = "custom_group_field";
	
	/**
	 * initializes the default class attributes
	 *
	 * @return void
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes ();
	}
	
	/**
	 * Returns the title of the field
	 *
	 * @return string
	 */
	public function getTitle() {
		// make title
		$title = $this->metadata_label;
		
		if (empty ( $title )) {
			$trans_key = "groups:" . $this->metadata_name;
			if ($trans_key != elgg_echo ( $trans_key )) {
				$title = elgg_echo ( $trans_key );
			} else {
				$title = $this->metadata_name;
			}
		}
		
		return $title;
	}
}
