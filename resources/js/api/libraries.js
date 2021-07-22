import axios from 'axios';

const LibrariesApi = {
	/**
	 * Search libraries
	 *
	 * @return JSON response
	 */
	search: () => axios.get('api/v1/libraries/search')
};

export default LibrariesApi;
