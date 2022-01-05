const autocannon = require('autocannon');

const API_URL = 'http://localhost:8090';
const WORKER_THREADS = 1;
const CONCURRENT_CONNECTIONS = 10;
const NUMBER_OF_REQUESTS = 1000;
const CONNECTION_TIMEOUT_IN_MILLISECOND = 1000;

const CONFIGS = {
  url: API_URL,
  workers: WORKER_THREADS,
  connections: CONCURRENT_CONNECTIONS,
  amount: NUMBER_OF_REQUESTS,
  timeout: CONNECTION_TIMEOUT_IN_MILLISECOND,
};

(async () => {
  const insertTodoList = autocannon({
    ...CONFIGS,
    requests: [{
      method: 'POST',
      path: '/todo-items',
      headers: {
        'Content-type': 'application/json;'
      },
      body: JSON.stringify({
        activity_group_id: 1,
        title: 'Task-[<id>]',
      })
    }],
    idReplacement: true,
  });

  const showTodoLists = autocannon({
    ...CONFIGS,
    requests: [{
      method: 'GET',
      path: '/todo-items',
      headers: {
        'Content-type': 'application/json;'
      },
    }],
  });

  const testsCase = await Promise.all([insertTodoList, showTodoLists]);

  const benchmarksResult = testsCase.reduce((result, value) => ({
    failed: (result.failed + value.non2xx) / 2,
    latencyAverage: (result.latencyAverage + value.latency.average) / 2,
    requestsAverage: (result.requestsAverage + value.requests.average) / 2,
    throughputAverage: (result.throughputAverage + value.throughput.average) / 2,
  }), { failed: 0, latencyAverage: 0, requestsAverage: 0, throughputAverage: 0 });

  console.log(`Requests failed: ${benchmarksResult.failed}`);
  console.log(`Average latency: ${benchmarksResult.latencyAverage} ms`);
  console.log(`Average req/sec: ${benchmarksResult.requestsAverage}`);
  console.log(`Average bytes/sec: ${benchmarksResult.throughputAverage} MB`);
})();