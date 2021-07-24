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

	/**
	 * Update author
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	update: (payload) => axios.patch(`api/v1/authors/${payload.id}`, payload),
};

export default AuthorsApi;
