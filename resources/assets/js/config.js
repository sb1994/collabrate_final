export const apiDomain = 'http://localhost/collabrate/public/'
export const authenticateUrl = apiDomain+'oauth/token'
export const userUrl = apiDomain+"api/user"
export const loginUrl = apiDomain+"api/login"
export const registerUrl = apiDomain+"api/register"
export const getHeaders =function() {
  const tokenData =JSON.parse(window.localStorage.getItem('token'))
  const headers = {
    'Accept':'application/json',
    'Authorization': 'Bearer '+tokenData.access_token
  }
  return headers;
}
