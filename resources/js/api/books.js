import axios from 'axios';

const BooksApi = {
	/**
	 * Search all books
	 *
	 * @return JSON response
	 */
	search: () => axios.get('api/v1/books/search'),

	/**
	 * Store book
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	store: () => axios.post('api/v1/books', payload),
};

export default BooksApi;
