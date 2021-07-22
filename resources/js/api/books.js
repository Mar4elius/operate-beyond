import axios from 'axios';

const BooksApi = {
	/**
	 * Search all books
	 *
	 * @return JSON response
	 */
	search: () => axios.get('api/v1/books/search')
};

export default BooksApi;
