import http from 'k6/http';
import { check } from 'k6';

export const options = {
  vus: 10,          // 50 usuarios virtuales a la vez
  duration: '20s',  // durante 30 segundos
};

// La URL se pasa desde la terminal
const URL = __ENV.URL;

export default function () {
  const res = http.get(URL);
  check(res, { 'status 200': (r) => r.status === 200 });
}