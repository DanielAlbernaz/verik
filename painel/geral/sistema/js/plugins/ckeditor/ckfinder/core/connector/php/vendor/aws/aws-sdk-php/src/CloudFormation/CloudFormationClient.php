<?php
namespace Aws\CloudFormation;

use Aws\AwsClient;

/**
 * This client is used to interact with the **AWS CloudFormation** service.
 *
 * @method \Aws\Result cancelUpdateStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise cancelUpdateStackAsync(array $args = [])
 * @method \Aws\Result continueUpdateRollback(array $args = [])
 * @method \GuzzleHttp\Promise\Promise continueUpdateRollbackAsync(array $args = [])
 * @method \Aws\Result createChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createChangeSetAsync(array $args = [])
 * @method \Aws\Result createStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStackAsync(array $args = [])
 * @method \Aws\Result createStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStackInstancesAsync(array $args = [])
 * @method \Aws\Result createStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStackSetAsync(array $args = [])
 * @method \Aws\Result deleteChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteChangeSetAsync(array $args = [])
 * @method \Aws\Result deleteStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStackAsync(array $args = [])
 * @method \Aws\Result deleteStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStackInstancesAsync(array $args = [])
 * @method \Aws\Result deleteStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStackSetAsync(array $args = [])
 * @method \Aws\Result describeAccountLimits(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAccountLimitsAsync(array $args = [])
 * @method \Aws\Result describeChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeChangeSetAsync(array $args = [])
 * @method \Aws\Result describeStackDriftDetectionStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackDriftDetectionStatusAsync(array $args = [])
 * @method \Aws\Result describeStackEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackEventsAsync(array $args = [])
 * @method \Aws\Result describeStackInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackInstanceAsync(array $args = [])
 * @method \Aws\Result describeStackResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackResourceAsync(array $args = [])
 * @method \Aws\Result describeStackResourceDrifts(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackResourceDriftsAsync(array $args = [])
 * @method \Aws\Result describeStackResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackResourcesAsync(array $args = [])
 * @method \Aws\Result describeStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackSetAsync(array $args = [])
 * @method \Aws\Result describeStackSetOperation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStackSetOperationAsync(array $args = [])
 * @method \Aws\Result describeStacks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeStacksAsync(array $args = [])
 * @method \Aws\Result detectStackDrift(array $args = [])
 * @method \GuzzleHttp\Promise\Promise detectStackDriftAsync(array $args = [])
 * @method \Aws\Result detectStackResourceDrift(array $args = [])
 * @method \GuzzleHttp\Promise\Promise detectStackResourceDriftAsync(array $args = [])
 * @method \Aws\Result estimateTemplateCost(array $args = [])
 * @method \GuzzleHttp\Promise\Promise estimateTemplateCostAsync(array $args = [])
 * @method \Aws\Result executeChangeSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise executeChangeSetAsync(array $args = [])
 * @method \Aws\Result getStackPolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStackPolicyAsync(array $args = [])
 * @method \Aws\Result getTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTemplateAsync(array $args = [])
 * @method \Aws\Result getTemplateSummary(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getTemplateSummaryAsync(array $args = [])
 * @method \Aws\Result listChangeSets(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listChangeSetsAsync(array $args = [])
 * @method \Aws\Result listExports(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listExportsAsync(array $args = [])
 * @method \Aws\Result listImports(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listImportsAsync(array $args = [])
 * @method \Aws\Result listStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackInstancesAsync(array $args = [])
 * @method \Aws\Result listStackResources(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackResourcesAsync(array $args = [])
 * @method \Aws\Result listStackSetOperationResults(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackSetOperationResultsAsync(array $args = [])
 * @method \Aws\Result listStackSetOperations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackSetOperationsAsync(array $args = [])
 * @method \Aws\Result listStackSets(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStackSetsAsync(array $args = [])
 * @method \Aws\Result listStacks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStacksAsync(array $args = [])
 * @method \Aws\Result setStackPolicy(array $args = [])
 * @method \GuzzleHttp\Promise\Promise setStackPolicyAsync(array $args = [])
 * @method \Aws\Result signalResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise signalResourceAsync(array $args = [])
 * @method \Aws\Result stopStackSetOperation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopStackSetOperationAsync(array $args = [])
 * @method \Aws\Result updateStack(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStackAsync(array $args = [])
 * @method \Aws\Result updateStackInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStackInstancesAsync(array $args = [])
 * @method \Aws\Result updateStackSet(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStackSetAsync(array $args = [])
 * @method \Aws\Result updateTerminationProtection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateTerminationProtectionAsync(array $args = [])
 * @method \Aws\Result validateTemplate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise validateTemplateAsync(array $args = [])
 */
class CloudFormationClient extends AwsClient {}
