import axios from 'axios';

const AuthorsApi = {
	/**
	 * Search authors
	 *
	 * @return JSON response
	 */
	search: () => axios.get('api/v1/authors/search'),

	/**
	 * Store author
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	store: (payload) => axios.post('api/v1/authors', payload),
};

export default AuthorsApi;
