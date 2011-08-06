<?php    
namespace my\blog;

class ListController extends \my\Mvc\AbstractPageController {                   

	public function singleAction() {                     
		$request = $this->_dispatcher->getRequest();    
		$blog_entry = new \my\blog\BlogEntry($request);     
		$this->_view->add($blog_entry);
	}           
	
	public function multiAction() {
		/**
		 
		$request = $this->_dispatcher->getRequest();
		//req-uri: /blog/2011
		//contains vars: $year
		
		$blog_entries = new BlogEntriesList($request);
		
		// do some domain-stuff on the list, e.g.:
		// $blog_entries->rm("blog-entries-title-that-is-to-be-removed-from-the-list");
		// $blog_entries->add("/2010/08/my-fancy-blog-post-from august");
		// $blog_entries->porcelain_view(); // spare view
		
		$this->_view->add($blog_entries);
		 
		*/
	}
}