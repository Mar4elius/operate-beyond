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
	store: (payload) => axios.post('api/v1/books', payload),

	/**
	 * Update book
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	update: (payload) => axios.patch(`api/v1/books/${payload.id}`, payload),

	/**
	 * Destroy book
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	destroy: (payload) => axios.delete(`api/v1/books/${payload.id}`),
};

export default BooksApi;
