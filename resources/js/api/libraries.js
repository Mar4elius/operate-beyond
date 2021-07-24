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
	store: (payload) => axios.post('api/v1/libraries/', payload),

	/**
	 * Update library
	 *
     * @param payload
     *
	 * @return JSON response
	 */
	update: (payload) => axios.patch(`api/v1/libraries/${payload.id}`, payload)
};

export default LibrariesApi;
