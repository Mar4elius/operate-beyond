import axios from 'axios';

const LibrariesApi = {
	/**
	 * Search libraries
	 *
	 * @return JSON response
	 */
	search: () => axios.get('api/v1/libraries/search'),

	/**
	 * Store library
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	store: (payload) => axios.post('api/v1/libraries/', payload)
};

export default LibrariesApi;
