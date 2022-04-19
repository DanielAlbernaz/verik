<?php
namespace Aws\Glue;

use Aws\AwsClient;

/**
 * This client is used to interact with the **AWS Glue** service.
 * @method \Aws\Result batchCreatePartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchCreatePartitionAsync(array $args = [])
 * @method \Aws\Result batchDeleteConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchDeleteConnectionAsync(array $args = [])
 * @method \Aws\Result batchDeletePartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchDeletePartitionAsync(array $args = [])
 * @method \Aws\Result batchDeleteTable(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchDeleteTableAsync(array $args = [])
 * @method \Aws\Result batchDeleteTableVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchDeleteTableVersionAsync(array $args = [])
 * @method \Aws\Result batchGetPartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchGetPartitionAsync(array $args = [])
 * @method \Aws\Result batchStopJobRun(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchStopJobRunAsync(array $args = [])
 * @method \Aws\Result createClassifier(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createClassifierAsync(array $args = [])
 * @method \Aws\Result createConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createConnectionAsync(array $args = [])
 * @method \Aws\Result createCrawler(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createCrawlerAsync(array $args = [])
 * @method \Aws\Result createDatabase(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDatabaseAsync(array $args = [])
 * @method \Aws\Result createDevEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDevEndpointAsync(array $args = [])
 * @method \Aws\Result createJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createJobAsync(array $args = [])
 * @method \Aws\Result createPartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createPartitionAsync(array $args = [])
 * @method \Aws\Result createScript(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createScriptAsync(array $args = [])
 * @method \Aws\Result createSecurityConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createSecurityConfigurationAsync(array $args = [])
 * @method \Aws\Result createTable(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createTableAsync(array $args = [])
 * @method \Aws\Result createTrigger(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createTriggerAsync(array $args = [])
 * @method \Aws\Result createUserDefinedFunction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createUserDefinedFunctionAsync(array $args = [])
 * @method \Aws\Result deleteClassifier(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteClassifierAsync(array $args = [])
 * @method \Aws\Result deleteConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteConnectionAsync(array $args = [])
 * @method \Aws\Result deleteCrawler(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCrawlerAsync(array $args = [])
 * @method \Aws\Result deleteDatabase(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDatabaseAsync(array $args = [])
 * @method \Aws\Result deleteDevEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDevEndpointAsync(array $args = [])
 * @method \Aws\Result deleteJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteJobAsync(array $args = [])
 * @method \Aws\Result deletePartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deletePartitionAsync(array $args = [])
 * @method \Aws\Result deleteResourcePolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteResourcePolicyAsync(array $args = [])
 * @method \Aws\Result deleteSecurityConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteSecurityConfigurationAsync(array $args = [])
 * @method \Aws\Result deleteTable(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteTableAsync(array $args = [])
 * @method \Aws\Result deleteTableVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteTableVersionAsync(array $args = [])
 * @method \Aws\Result deleteTrigger(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteTriggerAsync(array $args = [])
 * @method \Aws\Result deleteUserDefinedFunction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserDefinedFunctionAsync(array $args = [])
 * @method \Aws\Result getCatalogImportStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCatalogImportStatusAsync(array $args = [])
 * @method \Aws\Result getClassifier(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getClassifierAsync(array $args = [])
 * @method \Aws\Result getClassifiers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getClassifiersAsync(array $args = [])
 * @method \Aws\Result getConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getConnectionAsync(array $args = [])
 * @method \Aws\Result getConnections(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getConnectionsAsync(array $args = [])
 * @method \Aws\Result getCrawler(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCrawlerAsync(array $args = [])
 * @method \Aws\Result getCrawlerMetrics(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCrawlerMetricsAsync(array $args = [])
 * @method \Aws\Result getCrawlers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCrawlersAsync(array $args = [])
 * @method \Aws\Result getDataCatalogEncryptionSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDataCatalogEncryptionSettingsAsync(array $args = [])
 * @method \Aws\Result getDatabase(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDatabaseAsync(array $args = [])
 * @method \Aws\Result getDatabases(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDatabasesAsync(array $args = [])
 * @method \Aws\Result getDataflowGraph(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDataflowGraphAsync(array $args = [])
 * @method \Aws\Result getDevEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDevEndpointAsync(array $args = [])
 * @method \Aws\Result getDevEndpoints(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDevEndpointsAsync(array $args = [])
 * @method \Aws\Result getJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getJobAsync(array $args = [])
 * @method \Aws\Result getJobRun(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getJobRunAsync(array $args = [])
 * @method \Aws\Result getJobRuns(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getJobRunsAsync(array $args = [])
 * @method \Aws\Result getJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getJobsAsync(array $args = [])
 * @method \Aws\Result getMapping(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getMappingAsync(array $args = [])
 * @method \Aws\Result getPartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getPartitionAsync(array $args = [])
 * @method \Aws\Result getPartitions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getPartitionsAsync(array $args = [])
 * @method \Aws\Result getPlan(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getPlanAsync(array $args = [])
 * @method \Aws\Result getResourcePolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getResourcePolicyAsync(array $args = [])
 * @method \Aws\Result getSecurityConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSecurityConfigurationAsync(array $args = [])
 * @method \Aws\Result getSecurityConfigurations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSecurityConfigurationsAsync(array $args = [])
 * @method \Aws\Result getTable(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTableAsync(array $args = [])
 * @method \Aws\Result getTableVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTableVersionAsync(array $args = [])
 * @method \Aws\Result getTableVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTableVersionsAsync(array $args = [])
 * @method \Aws\Result getTables(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTablesAsync(array $args = [])
 * @method \Aws\Result getTrigger(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTriggerAsync(array $args = [])
 * @method \Aws\Result getTriggers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTriggersAsync(array $args = [])
 * @method \Aws\Result getUserDefinedFunction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUserDefinedFunctionAsync(array $args = [])
 * @method \Aws\Result getUserDefinedFunctions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUserDefinedFunctionsAsync(array $args = [])
 * @method \Aws\Result importCatalogToGlue(array $args = [])
 * @method \GuzzleHttp\Promise\Promise importCatalogToGlueAsync(array $args = [])
 * @method \Aws\Result putDataCatalogEncryptionSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putDataCatalogEncryptionSettingsAsync(array $args = [])
 * @method \Aws\Result putResourcePolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putResourcePolicyAsync(array $args = [])
 * @method \Aws\Result resetJobBookmark(array $args = [])
 * @method \GuzzleHttp\Promise\Promise resetJobBookmarkAsync(array $args = [])
 * @method \Aws\Result startCrawler(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startCrawlerAsync(array $args = [])
 * @method \Aws\Result startCrawlerSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startCrawlerScheduleAsync(array $args = [])
 * @method \Aws\Result startJobRun(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startJobRunAsync(array $args = [])
 * @method \Aws\Result startTrigger(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startTriggerAsync(array $args = [])
 * @method \Aws\Result stopCrawler(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopCrawlerAsync(array $args = [])
 * @method \Aws\Result stopCrawlerSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopCrawlerScheduleAsync(array $args = [])
 * @method \Aws\Result stopTrigger(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopTriggerAsync(array $args = [])
 * @method \Aws\Result updateClassifier(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateClassifierAsync(array $args = [])
 * @method \Aws\Result updateConnection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateConnectionAsync(array $args = [])
 * @method \Aws\Result updateCrawler(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCrawlerAsync(array $args = [])
 * @method \Aws\Result updateCrawlerSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCrawlerScheduleAsync(array $args = [])
 * @method \Aws\Result updateDatabase(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateDatabaseAsync(array $args = [])
 * @method \Aws\Result updateDevEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateDevEndpointAsync(array $args = [])
 * @method \Aws\Result updateJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateJobAsync(array $args = [])
 * @method \Aws\Result updatePartition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updatePartitionAsync(array $args = [])
 * @method \Aws\Result updateTable(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateTableAsync(array $args = [])
 * @method \Aws\Result updateTrigger(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateTriggerAsync(array $args = [])
 * @method \Aws\Result updateUserDefinedFunction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateUserDefinedFunctionAsync(array $args = [])
 */
class GlueClient extends AwsClient {}
