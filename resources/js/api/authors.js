import axios from 'axios';

const AuthorsApi = {
	/**
	 * Search authors
	 *
	 * @return JSON response
	 */
	search: () => axios.get('api/v1/authors/search'),
};

export default AuthorsApi;
