import axios from 'axios';

const BooksApi = {
    /**
	 * Search all books
	 *
	 * @param payload
	 *
	 * @return JSON response
	 */
    search: (payload) => axios.get('api/v1/books/search')
}

export default BooksApi;