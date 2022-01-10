const autocannon = require('autocannon');
const fetch = require('node-fetch');
const prettyBytes = require('pretty-bytes');
const { Command } = require('commander');

const program = new Command();
program.option('-u, --url <API URL>', 'API URL to run benchmark');
program.parse(process.argv);

const API_URL = program.opts().url ?? 'http://localhost:8090';
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
  console.log(`Running benchmarks on ${API_URL}\n\r`);

  const { data: { id: activityId } } = await fetch(`${API_URL}/activity-groups`, {
    method: 'POST',
    headers: {
      'Content-type': 'application/json'
    },
    body: JSON.stringify({
      title: 'Benchmark',
    })
  }).then((response) => response.json());

  // autocannon --timeout 20000 --connections 10 --amount 3000 --workers 1 --method POST --body '{"title": "Hello", "activity_group_id": 2}'  http://localhost:8090/todo-items
  const insertTodoList = await autocannon({
    ...CONFIGS,
    requests: [{
      method: 'POST',
      path: '/todo-items',
      headers: {
        'Content-type': 'application/json',
      },
      body: JSON.stringify({
        activity_group_id: activityId,
        title: 'Task-[<id>]',
      })
    }],
    idReplacement: true,
  });

  // autocannon --timeout 20000 --connections 10 --amount 3000 --workers 1 --method GET http://localhost:8090/todo-items?activity_group_id=2
  const showTodoLists = await autocannon({
    ...CONFIGS,
    requests: [{
      method: 'GET',
      path: `/todo-items?activity_group_id=${activityId}`,
      headers: {
        'Content-type': 'application/json',
      },
    }],
  });

  const benchmarksResult = [insertTodoList, showTodoLists].reduce((result, value) => ({
    failed: result.failed + value.non2xx,
    latencyAverage: (result.latencyAverage + value.latency.average) / 2,
    requestsAverage: (result.requestsAverage + value.requests.average) / 2,
    throughputAverage: (result.throughputAverage + value.throughput.average) / 2,
  }), { failed: 0, latencyAverage: 0, requestsAverage: 0, throughputAverage: 0 });

  console.log(`Requests failed: ${benchmarksResult.failed}`);
  console.log(`Average latency: ${benchmarksResult.latencyAverage} ms`);
  console.log(`Average req/sec: ${benchmarksResult.requestsAverage}`);
  console.log(`Average bytes/sec: ${prettyBytes(benchmarksResult.throughputAverage)}`);
})();
