<?php

namespace App\Http\Controllers;

class BibleController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function getBooks($search = '___') {
		$books = \App\Bible::where('version', 'web');
		if ($search != '___') {
			$books = $books->where('book', 'LIKE', $search . '%');
		}
		$books = $books->groupBy('book')

			->get(array('book'));
		return $books;
	}

	public function showBookSearch($searchTerm = '___') {
		$books = $this->getBooks($searchTerm);
		return view('bible/book-search', array('books' => $books));
	}
}
