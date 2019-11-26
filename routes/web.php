<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*!

=========================================================
* Web Perpustakaan - v1.0.0
=========================================================

* Coded by: 
* Munajat Abdul Hafiz
* Yudhistira Eka Paksi
* Reginal Mahendra
* Alfian Miftahul
* Jesica Naomi
* Moh Kodir
* Fauzan Shidqi

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/

use App\Author;
use App\AuthorBook;
use App\Book;
use App\Transaction;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// ---ABOUT US---
Route::get('/about', function () {
	return view('about');
});

// ---OPAC SEARCH---
Route::get('/opac/search', ['as' => 'search', 'uses' => function(Request $request) {
	$search = $request->get('data');
	$searchSplit = explode(' ', $search);

	$this->searchQueryItems = [];
	foreach ($searchSplit as $searchTerm) {
		$this->searchQueryItems[] = "%" . trim($searchTerm) . "%";
	}

	$buku = Book::join('bibliografis', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id')
		->select('bibliografis.*', 'books.*')
		->where('books.opac', '=', 'show')
		->where(function ($query) {
			$query->where('bibliografis.judul', 'like', $this->searchQueryItems)
			->orWhere('bibliografis.anak_judul', 'like', $this->searchQueryItems)
			->orWhere('bibliografis.isbn', 'like', $this->searchQueryItems);
		})
		->latest('books.buku_id')
		->paginate(15);

	$peminjaman = Transaction::where('status', 3)->get();
	$count = $buku->count();

	return view('opac.index', [
		'buku' => $buku,
		'peminjaman' => $peminjaman,
		'data' => $search,
		'count' => $count
	]);
}]);

// ---OPAC SHOW---
Route::get('/opac/show/{id}', function($id) {
	$buku = Book::where('books.bibliografi_id', $id)
		->join('bibliografis', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id')
		->join('author_books', 'books.buku_id', '=', 'author_books.buku_id', 'left outer')
		->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
		->join('written_forms', 'books.karya_tulis_id', '=', 'written_forms.id', 'left outer')
		->join('book_types', 'books.jenis_buku_id', '=', 'book_types.id', 'left outer')
		->join('source_types', 'bibliografis.jenis_sumber_id', '=', 'source_types.id', 'left outer')
		->join('languages', 'bibliografis.bahasa_id', '=', 'languages.id', 'left outer')
		->join('categories', 'bibliografis.kategori_id', '=', 'categories.id', 'left outer')
		->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
		->join('accesses', 'bibliografis.akses_id', '=', 'accesses.id', 'left outer')
		->select(
			'bibliografis.*', 'books.*', 'author_books.authors_id', 
			'author_books.buku_id AS author_book', 'locations.*', 'written_forms.*', 
			'book_types.*', 'source_types.*', 'languages.*',
			'categories.*', 'users.*', 'accesses.*'
			)
		->get();

	if ($buku[0]['opac'] == 'hide') {
		return abort(404);
	}

	$authors = Author::get();
	$peminjaman = Transaction::where('status', 3)->get();

	return view('opac.detail', [
		'buku' => $buku,
		'authors' => $authors,
		'double' => 0,
		'peminjaman' => $peminjaman,
	]);
});

// ---SHOW PDF IN BROWSER
Route::get('/opac/read/{id}/{book}', function($id) {
	$buku = Book::where('books.bibliografi_id', $id)->first();
	$pathToFile = "storage/file/".$buku->file;

	return response()->file($pathToFile);
});

Auth::routes(['verify' => true]);

// ---HOME---
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'verified', 'checkstatus']], function () {
	// ---OPAC FOR ADMIN---
	Route::get('opac', 'HomeController@opac');
	
	// ---USER CONTROLLER---
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('data/{id}', 'UserController@index');
	Route::get('user/{err}', 'UserController@error');
	Route::get('data/{id}/create', 'UserController@create');
	Route::post('data/{id}', 'UserController@store');
	Route::delete('data/{id}/{user_id}', 'UserController@destroy');
	Route::delete('data/{user}/{status}/{id}', 'userController@updateStatus');

	// ---PROFILE CONTROLLER---
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfilesController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfilesController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfilesController@password']);

	// ---TRANSACTION CONTROLLER---
	Route::get('/peminjaman', 'TransactionsController@index');
	Route::get('/peminjaman/buku', 'TransactionsController@create');
	Route::get('/peminjaman/buku/{id}', 'TransactionsController@createFromOpac');
	Route::post('/peminjaman', 'TransactionsController@store');
	Route::get('/peminjaman/cancel/{kode}', 'TransactionsController@cancel');
	Route::get('/peminjaman/{kode}/{id}', 'TransactionsController@pinjam');
	Route::delete('/peminjaman/delete/{kode}', 'TransactionsController@destroy');

	// ---BIBLIOGRAFI BOOK CONTROLLER---
	Route::get('bibliografi/book', 'BooksController@index');
	Route::get('bibliografi/book/create', 'BooksController@create');
	Route::post('bibliografi/book', 'BooksController@store');
	Route::get('bibliografi/book/edit/{bibli}', 'BooksController@edit');
	Route::put('bibliografi/book/edit/{bibli}', 'BooksController@update');
	Route::delete('bibliografi/book/{bibli}', 'BooksController@destroy');

	// ---BIBLIOGRAFI CD CONTROLLER---
	Route::get('bibliografi/cd', 'CdsController@index');
	Route::get('bibliografi/cd/create', 'CdsController@create');
	Route::post('bibliografi/cd', 'CdsController@store');
	Route::get('bibliografi/cd/edit/{bibli}', 'CdsController@edit');
	Route::put('bibliografi/cd/edit/{bibli}', 'CdsController@update');
	Route::delete('bibliografi/cd/{bibli}', 'CdsController@destroy');
	Route::get('bibliografi/cd/{id}/download', 'CdsController@getDownload');

	// ---AUTHOR CONTROLLER---
	Route::get('/bibliografi/book/author', 'AuthorsController@index');
	Route::post('/bibliografi/book/author', 'AuthorsController@store');
	Route::put('/bibliografi/book/author/{id}', 'AuthorsController@update');
	Route::delete('/bibliografi/book/author/{id}', 'AuthorsController@destroy');
	
	// ---SONGWRITER CONTROLLER---
	Route::get('/bibliografi/cd/songwriter', 'SongwritersController@index');
	Route::post('/bibliografi/cd/songwriter', 'SongwritersController@store');
	Route::put('/bibliografi/cd/songwriter/{id}', 'SongwritersController@update');
	Route::delete('/bibliografi/cd/songwriter/{id}', 'SongwritersController@destroy');
	
	// ---EXPORT---
	Route::post('/bibliografi/{id}/export/view', 'BibliografisController@export_view');
	Route::get('/bibliografi/{id}/export/excel/{date}', 'BibliografisController@export_excel');
	Route::post('/guestbook-all-data/export/view', 'GuestBookController@export_view');
	Route::get('/guestbook-all-data/export/excel/{date}', 'GuestBookController@export_excel');

	// ---IMPORT---
	Route::post('/bibliografi/{id}/import/excel', 'BibliografisController@import_excel');

	// ---GUEST BOOK---
	Route::get('/guestbook-all-data', 'GuestBookController@index');
	Route::get('/guestbook/{id}', 'GuestBookController@guestbook');
	Route::post('/guestbook/member', 'GuestBookController@store_member');
	Route::post('/guestbook/non-member', 'GuestBookController@store_nonMember');
	Route::post('/guestbook/group', 'GuestBookController@store_group');

	// ---JSON CHART---
	Route::get('/json/chart/visitor', 'HomeController@chartVisitor');
	Route::get('/json/chart/input', 'HomeController@chartInput');

	// ---CAROUSEL EVENT---
	Route::get('/carousel-event', 'CarouselController@index');
	Route::put('/carousel-event/{id}', 'CarouselController@update');

	// ---ID CARD---
	Route::get('/data/user/print-id-card/{id}', 'UserController@id_card');

	// ---FINE---
	Route::put('/peminjaman/pembayaran/{id}', 'TransactionsController@bayar');

	// ---DOWNLOAD EXAMPLE EXCEL---
	Route::get('/bibliografi/{id}/download/example-excel', 'BibliografisController@download_example');

	
	// ADD NEW DATA FOR SELECT OPTION IN BOOK AND CD FORM
	Route::get('/btnSelect/{table}/{val}', function($table, $val){
		if ($table == "bahasa") {
			App\Language::create(['bahasa' => $val]);
			$lang = App\Language::where('bahasa', $val)->first();
			$val = $lang->bahasa;
			$alert = "Bahasa";
		}
		elseif ($table == "kategori") {
			App\Categories::create(['kategori' => $val]);
			$lang = App\Categories::where('kategori', $val)->first();
			$val = $lang->kategori;
			$alert = "Kategori";
		} 
		elseif ($table == "akses") {
			App\Access::create([
				'akses' => $val,
				]);
			$lang = App\Access::where('akses', $val)->first();
			$val = $lang->akses;
			$alert = "Akses";
		}
		elseif ($table == "lokasi") {
			App\Location::create(['lokasi' => $val]);
			$lang = App\Location::where('lokasi', $val)->first();
			$val = $lang->lokasi;
			$alert = "Lokasi";
		}
		elseif ($table == "klasifikasi") {
			App\BookClassification::create(['klasifikasi_buku' => $val]);
			$lang = App\BookClassification::where('klasifikasi_buku', $val)->first();
			$val = $lang->klasifikasi_buku;
			$alert = "Klasifikasi Buku";
		}
		elseif ($table == "subjek") {
			App\BookSubject::create(['subjek' => $val]);
			$lang = App\BookSubject::where('subjek', $val)->first();
			$val = $lang->subjek;
			$alert = "Subjek Buku";
		}
		elseif ($table == "karya-tulis") {
			App\WrittenForm::create(['bentuk_karya_tulis' => $val]);
			$lang = App\WrittenForm::where('bentuk_karya_tulis', $val)->first();
			$val = $lang->bentuk_karya_tulis;
			$alert = "Bentuk Karya Tulis";
		}
		elseif ($table == "jenis-buku") {
			App\BookType::create(['jenis_buku' => $val]);
			$lang = App\BookType::where('jenis_buku', $val)->first();
			$val = $lang->jenis_buku;
			$alert = "Jenis Buku";
		}
		elseif ($table == "sumber") {
			App\SourceType::create(['jenis_sumber' => $val]);
			$lang = App\SourceType::where('jenis_sumber', $val)->first();
			$val = $lang->jenis_sumber;
			$alert = "Jenis Sumber";
		}
		elseif ($table == "genre") {
			App\Genre::create(['genre' => $val]);
			$lang = App\Genre::where('genre', $val)->first();
			$val = $lang->genre;
			$alert = "Genre";
		}
		elseif ($table == 'songwriter') {
			App\Songwriter::create(['name' => $val]);
			$lang = App\Songwriter::where('name', $val)->first();
			$val = $lang->name;
			$alert = "Pencipta Lagu";
		}
		
		$coba = "Berhasil Tambah " . $alert;
		$id = $lang->id;
		$arr = [$coba, $id, $val];
		return $arr;
	});

	Route::get('/btnSelect/{table}/{stats}/{val}', function($table, $stats, $val){
		if ($stats === "Primary") {
			App\Author::create(['name' => $val, 'status' => $stats]);
			$lang = App\Author::where('name', $val)->first();
			$alert = "Pengarang Utama";
			$valName = $lang->name;
			$valStats = $lang->status;
		}
		elseif ($stats === "Additional") {
			App\Author::create(['name' => $val, 'status' => $stats]);
			$lang = App\Author::where('name', $val)->first();
			$alert = "Pengarang Tambahan";
			$valName = $lang->name;
			$valStats = $lang->status;
		}
		elseif ($table === "currency") {
			App\Currencies::create(['currency' => $val, 'code' => $stats]);
			$lang = App\Currencies::where('currency', $val)->first();
			$alert = "Mata Uang";
			$valName = $lang->currency;
			$valStats = $lang->code;
		}

		$coba = "Berhasil Tambah " . $alert;
		$id = $lang->id;
		$arr = [$coba, $id, $valStats, $valName];
		return $arr;
	});

});