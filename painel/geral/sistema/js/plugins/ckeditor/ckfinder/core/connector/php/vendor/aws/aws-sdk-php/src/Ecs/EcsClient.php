<?php
namespace Aws\Ecs;

use Aws\AwsClient;

/**
 * This client is used to interact with **Amazon ECS**.
 *
 * @method \Aws\Result createCluster(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createClusterAsync(array $args = [])
 * @method \Aws\Result createService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createServiceAsync(array $args = [])
 * @method \Aws\Result deleteAccountSetting(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAccountSettingAsync(array $args = [])
 * @method \Aws\Result deleteAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAttributesAsync(array $args = [])
 * @method \Aws\Result deleteCluster(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteClusterAsync(array $args = [])
 * @method \Aws\Result deleteService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteServiceAsync(array $args = [])
 * @method \Aws\Result deregisterContainerInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deregisterContainerInstanceAsync(array $args = [])
 * @method \Aws\Result deregisterTaskDefinition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deregisterTaskDefinitionAsync(array $args = [])
 * @method \Aws\Result describeClusters(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeClustersAsync(array $args = [])
 * @method \Aws\Result describeContainerInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeContainerInstancesAsync(array $args = [])
 * @method \Aws\Result describeServices(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeServicesAsync(array $args = [])
 * @method \Aws\Result describeTaskDefinition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeTaskDefinitionAsync(array $args = [])
 * @method \Aws\Result describeTasks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeTasksAsync(array $args = [])
 * @method \Aws\Result discoverPollEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise discoverPollEndpointAsync(array $args = [])
 * @method \Aws\Result listAccountSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAccountSettingsAsync(array $args = [])
 * @method \Aws\Result listAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAttributesAsync(array $args = [])
 * @method \Aws\Result listClusters(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listClustersAsync(array $args = [])
 * @method \Aws\Result listContainerInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listContainerInstancesAsync(array $args = [])
 * @method \Aws\Result listServices(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listServicesAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result listTaskDefinitionFamilies(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTaskDefinitionFamiliesAsync(array $args = [])
 * @method \Aws\Result listTaskDefinitions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTaskDefinitionsAsync(array $args = [])
 * @method \Aws\Result listTasks(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTasksAsync(array $args = [])
 * @method \Aws\Result putAccountSetting(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putAccountSettingAsync(array $args = [])
 * @method \Aws\Result putAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putAttributesAsync(array $args = [])
 * @method \Aws\Result registerContainerInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise registerContainerInstanceAsync(array $args = [])
 * @method \Aws\Result registerTaskDefinition(array $args = [])
 * @method \GuzzleHttp\Promise\Promise registerTaskDefinitionAsync(array $args = [])
 * @method \Aws\Result runTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise runTaskAsync(array $args = [])
 * @method \Aws\Result startTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startTaskAsync(array $args = [])
 * @method \Aws\Result stopTask(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopTaskAsync(array $args = [])
 * @method \Aws\Result submitContainerStateChange(array $args = [])
 * @method \GuzzleHttp\Promise\Promise submitContainerStateChangeAsync(array $args = [])
 * @method \Aws\Result submitTaskStateChange(array $args = [])
 * @method \GuzzleHttp\Promise\Promise submitTaskStateChangeAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateContainerAgent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateContainerAgentAsync(array $args = [])
 * @method \Aws\Result updateContainerInstancesState(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateContainerInstancesStateAsync(array $args = [])
 * @method \Aws\Result updateService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateServiceAsync(array $args = [])
 */
class EcsClient extends AwsClient {}
