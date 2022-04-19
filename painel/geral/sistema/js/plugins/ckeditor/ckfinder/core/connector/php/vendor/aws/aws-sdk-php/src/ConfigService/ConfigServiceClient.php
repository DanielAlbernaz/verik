<?php
namespace Aws\ConfigService;

use Aws\AwsClient;

/**
 * This client is used to interact with AWS Config.
 *
 * @method \Aws\Result batchGetAggregateResourceConfig(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchGetAggregateResourceConfigAsync(array $args = [])
 * @method \Aws\Result batchGetResourceConfig(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchGetResourceConfigAsync(array $args = [])
 * @method \Aws\Result deleteAggregationAuthorization(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAggregationAuthorizationAsync(array $args = [])
 * @method \Aws\Result deleteConfigRule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteConfigRuleAsync(array $args = [])
 * @method \Aws\Result deleteConfigurationAggregator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteConfigurationAggregatorAsync(array $args = [])
 * @method \Aws\Result deleteConfigurationRecorder(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteConfigurationRecorderAsync(array $args = [])
 * @method \Aws\Result deleteDeliveryChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDeliveryChannelAsync(array $args = [])
 * @method \Aws\Result deleteEvaluationResults(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEvaluationResultsAsync(array $args = [])
 * @method \Aws\Result deletePendingAggregationRequest(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deletePendingAggregationRequestAsync(array $args = [])
 * @method \Aws\Result deleteRetentionConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteRetentionConfigurationAsync(array $args = [])
 * @method \Aws\Result deliverConfigSnapshot(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deliverConfigSnapshotAsync(array $args = [])
 * @method \Aws\Result describeAggregateComplianceByConfigRules(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAggregateComplianceByConfigRulesAsync(array $args = [])
 * @method \Aws\Result describeAggregationAuthorizations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAggregationAuthorizationsAsync(array $args = [])
 * @method \Aws\Result describeComplianceByConfigRule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeComplianceByConfigRuleAsync(array $args = [])
 * @method \Aws\Result describeComplianceByResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeComplianceByResourceAsync(array $args = [])
 * @method \Aws\Result describeConfigRuleEvaluationStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigRuleEvaluationStatusAsync(array $args = [])
 * @method \Aws\Result describeConfigRules(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigRulesAsync(array $args = [])
 * @method \Aws\Result describeConfigurationAggregatorSourcesStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigurationAggregatorSourcesStatusAsync(array $args = [])
 * @method \Aws\Result describeConfigurationAggregators(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigurationAggregatorsAsync(array $args = [])
 * @method \Aws\Result describeConfigurationRecorderStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigurationRecorderStatusAsync(array $args = [])
 * @method \Aws\Result describeConfigurationRecorders(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeConfigurationRecordersAsync(array $args = [])
 * @method \Aws\Result describeDeliveryChannelStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDeliveryChannelStatusAsync(array $args = [])
 * @method \Aws\Result describeDeliveryChannels(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDeliveryChannelsAsync(array $args = [])
 * @method \Aws\Result describePendingAggregationRequests(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describePendingAggregationRequestsAsync(array $args = [])
 * @method \Aws\Result describeRetentionConfigurations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeRetentionConfigurationsAsync(array $args = [])
 * @method \Aws\Result getAggregateComplianceDetailsByConfigRule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAggregateComplianceDetailsByConfigRuleAsync(array $args = [])
 * @method \Aws\Result getAggregateConfigRuleComplianceSummary(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAggregateConfigRuleComplianceSummaryAsync(array $args = [])
 * @method \Aws\Result getAggregateDiscoveredResourceCounts(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAggregateDiscoveredResourceCountsAsync(array $args = [])
 * @method \Aws\Result getAggregateResourceConfig(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAggregateResourceConfigAsync(array $args = [])
 * @method \Aws\Result getComplianceDetailsByConfigRule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getComplianceDetailsByConfigRuleAsync(array $args = [])
 * @method \Aws\Result getComplianceDetailsByResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getComplianceDetailsByResourceAsync(array $args = [])
 * @method \Aws\Result getComplianceSummaryByConfigRule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getComplianceSummaryByConfigRuleAsync(array $args = [])
 * @method \Aws\Result getComplianceSummaryByResourceType(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getComplianceSummaryByResourceTypeAsync(array $args = [])
 * @method \Aws\Result getDiscoveredResourceCounts(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getDiscoveredResourceCountsAsync(array $args = [])
 * @method \Aws\Result getResourceConfigHistory(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getResourceConfigHistoryAsync(array $args = [])
 * @method \Aws\Result listAggregateDiscoveredResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAggregateDiscoveredResourcesAsync(array $args = [])
 * @method \Aws\Result listDiscoveredResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listDiscoveredResourcesAsync(array $args = [])
 * @method \Aws\Result putAggregationAuthorization(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putAggregationAuthorizationAsync(array $args = [])
 * @method \Aws\Result putConfigRule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putConfigRuleAsync(array $args = [])
 * @method \Aws\Result putConfigurationAggregator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putConfigurationAggregatorAsync(array $args = [])
 * @method \Aws\Result putConfigurationRecorder(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putConfigurationRecorderAsync(array $args = [])
 * @method \Aws\Result putDeliveryChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putDeliveryChannelAsync(array $args = [])
 * @method \Aws\Result putEvaluations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putEvaluationsAsync(array $args = [])
 * @method \Aws\Result putRetentionConfiguration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putRetentionConfigurationAsync(array $args = [])
 * @method \Aws\Result startConfigRulesEvaluation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startConfigRulesEvaluationAsync(array $args = [])
 * @method \Aws\Result startConfigurationRecorder(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startConfigurationRecorderAsync(array $args = [])
 * @method \Aws\Result stopConfigurationRecorder(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopConfigurationRecorderAsync(array $args = [])
 */
class ConfigServiceClient extends AwsClient {}
