import axios from 'axios';

// Auth
export const apiLogin = (email, password) => axios.post('/api/auth/login', { email, password });
export const apiRegister = (data) => axios.post('/api/auth/register', data);
export const apiLogout = () => axios.post('/api/auth/logout');
export const apiGetUser = () => axios.get('/api/auth/user');
export const apiForgotPassword = (email) => axios.post('/api/auth/forgot-password', { email });

// WordLists
export const apiGetWordLists = () => axios.get('/api/wordlists');
export const apiGetWordList = (id) => axios.get(`/api/wordlists/${id}`);
export const apiCreateWordList = (data) => axios.post('/api/wordlists', data);
export const apiUpdateWordList = (id, data) => axios.put(`/api/wordlists/${id}`, data);
export const apiDeleteWordList = (id) => axios.delete(`/api/wordlists/${id}`);
export const apiCopyWordList = (id) => axios.post(`/api/wordlists/${id}/copy`);
export const apiAddWord = (listId, data) => axios.post(`/api/wordlists/${listId}/words`, data);
export const apiDeleteWord = (id) => axios.delete(`/api/words/${id}`);
export const apiSwipeHandle = (wordId, direction) => axios.post('/api/swipe', { wordId, direction });

// Texts
export const apiGetTexts = () => axios.get('/api/texts');
export const apiGetText = (id) => axios.get(`/api/texts/${id}`);
export const apiCreateText = (data) => axios.post('/api/texts', data);
export const apiUpdateText = (id, data) => axios.put(`/api/texts/${id}`, data);
export const apiDeleteText = (id) => axios.delete(`/api/texts/${id}`);
export const apiGenerateText = (data) => axios.post('/api/texts/generate', data);

// Profile
export const apiUpdateProfile = (data) => axios.patch('/api/profile', data);
export const apiDeleteProfile = (data) => axios.delete('/api/profile', { data });
export const apiUpdateInterests = (interests) => axios.post('/api/profile/interests', { interests });
export const apiAddLanguage = (language) => axios.post('/api/profile/languages', { language });
export const apiRemoveLanguage = (id) => axios.delete(`/api/profile/languages/${id}`);
export const apiInitiateProfile = (data) => axios.post('/api/profile/initiate', data);
export const apiCancelSubscription = () => axios.post('/api/profile/cancel-subscription');

// Misc
export const apiGetLanguages = () => axios.get('/api/languages');
export const apiTranslate = (data) => axios.post('/api/translate', data);
export const apiGetHome = () => axios.get('/api/home');
export const apiGetPatchNotes = () => axios.get('/api/patch-notes');
export const apiGetPatchNote = (id) => axios.get(`/api/patch-notes/${id}`);
