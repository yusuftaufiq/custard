const autocannon = require('autocannon');

const API_URL = 'http://localhost:8008';
const WORKER_THREADS = 1;
const CONCURRENT_CONNECTIONS = 20;
const CONNECTION_DURATION_IN_SECOND = 20;
const CONNECTION_TIMEOUT_IN_MILLISECOND = 2000;

const CONFIGS = {
  url: API_URL,
  workers: WORKER_THREADS,
  connections: CONCURRENT_CONNECTIONS,
  duration: CONNECTION_DURATION_IN_SECOND,
  timeout: CONNECTION_TIMEOUT_IN_MILLISECOND,
};

(async () => {
  const insertActivity = await autocannon({
    ...CONFIGS,
    requests: [{
      method: 'POST',
      path: '/activity-groups',
      headers: {
        'Content-type': 'application/json;'
      },
      body: JSON.stringify({
        title: 'Hello World!',
        email: 'new-[<id>]@user.com',
      })
    }],
    idReplacement: true,
  });

  const showActivities = await autocannon({
    ...CONFIGS,
    requests: [{
      method: 'GET',
      path: '/activity-groups',
      headers: {
        'Content-type': 'application/json;'
      },
    }],
  });

  const showActivity = await autocannon({
    ...CONFIGS,
    requests: [{
      method: 'GET',
      path: '/activity-groups/1',
      headers: {
        'Content-type': 'application/json;'
      },
    }],
  });

  const updateActivity = await autocannon({
    ...CONFIGS,
    requests: [{
      method: 'PATCH',
      path: '/activity-groups/1',
      headers: {
        'Content-type': 'application/json;'
      },
      body: JSON.stringify({
        title: 'Hello World!',
        email: 'update-[<id>]@user.com',
      })
    }],
    idReplacement: true,
  });

  const benchmarksResult = [insertActivity, showActivities, showActivity, updateActivity].reduce((result, value) => ({
    failed: (result.failed + value.non2xx) / 2,
    latencyAverage: (result.latencyAverage + value.latency.average) / 2,
    requestsAverage: (result.requestsAverage + value.requests.average) / 2,
    throughputAverage: (result.throughputAverage + value.throughput.average) / 2,
  }), { failed: 0, latencyAverage: 0, requestsAverage: 0, throughputAverage: 0 });

  console.log(`Requests failed: ${benchmarksResult.failed}`);
  console.log(`Average latency: ${benchmarksResult.latencyAverage} ms`);
  console.log(`Average req/sec: ${benchmarksResult.requestsAverage}`);
  console.log(`Average bytes/sec: ${benchmarksResult.latencyAverage} MB`);
})();
