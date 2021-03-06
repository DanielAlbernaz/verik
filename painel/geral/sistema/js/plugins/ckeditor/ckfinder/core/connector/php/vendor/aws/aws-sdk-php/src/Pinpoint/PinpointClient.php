<?php
namespace Aws\Pinpoint;

use Aws\Api\ApiProvider;
use Aws\Api\DocModel;
use Aws\Api\Service;
use Aws\AwsClient;

/**
 * This client is used to interact with the **Amazon Pinpoint** service.
 * @method \Aws\Result createApp(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createAppAsync(array $args = [])
 * @method \Aws\Result createCampaign(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createCampaignAsync(array $args = [])
 * @method \Aws\Result createExportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createExportJobAsync(array $args = [])
 * @method \Aws\Result createImportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createImportJobAsync(array $args = [])
 * @method \Aws\Result createSegment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createSegmentAsync(array $args = [])
 * @method \Aws\Result deleteAdmChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAdmChannelAsync(array $args = [])
 * @method \Aws\Result deleteApnsChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteApnsChannelAsync(array $args = [])
 * @method \Aws\Result deleteApnsSandboxChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteApnsSandboxChannelAsync(array $args = [])
 * @method \Aws\Result deleteApnsVoipChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteApnsVoipChannelAsync(array $args = [])
 * @method \Aws\Result deleteApnsVoipSandboxChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteApnsVoipSandboxChannelAsync(array $args = [])
 * @method \Aws\Result deleteApp(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAppAsync(array $args = [])
 * @method \Aws\Result deleteBaiduChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteBaiduChannelAsync(array $args = [])
 * @method \Aws\Result deleteCampaign(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCampaignAsync(array $args = [])
 * @method \Aws\Result deleteEmailChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEmailChannelAsync(array $args = [])
 * @method \Aws\Result deleteEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEndpointAsync(array $args = [])
 * @method \Aws\Result deleteEventStream(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEventStreamAsync(array $args = [])
 * @method \Aws\Result deleteGcmChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteGcmChannelAsync(array $args = [])
 * @method \Aws\Result deleteSegment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteSegmentAsync(array $args = [])
 * @method \Aws\Result deleteSmsChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteSmsChannelAsync(array $args = [])
 * @method \Aws\Result deleteUserEndpoints(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteUserEndpointsAsync(array $args = [])
 * @method \Aws\Result deleteVoiceChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteVoiceChannelAsync(array $args = [])
 * @method \Aws\Result getAdmChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAdmChannelAsync(array $args = [])
 * @method \Aws\Result getApnsChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getApnsChannelAsync(array $args = [])
 * @method \Aws\Result getApnsSandboxChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getApnsSandboxChannelAsync(array $args = [])
 * @method \Aws\Result getApnsVoipChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getApnsVoipChannelAsync(array $args = [])
 * @method \Aws\Result getApnsVoipSandboxChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getApnsVoipSandboxChannelAsync(array $args = [])
 * @method \Aws\Result getApp(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAppAsync(array $args = [])
 * @method \Aws\Result getApplicationSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getApplicationSettingsAsync(array $args = [])
 * @method \Aws\Result getApps(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAppsAsync(array $args = [])
 * @method \Aws\Result getBaiduChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getBaiduChannelAsync(array $args = [])
 * @method \Aws\Result getCampaign(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCampaignAsync(array $args = [])
 * @method \Aws\Result getCampaignActivities(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCampaignActivitiesAsync(array $args = [])
 * @method \Aws\Result getCampaignVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCampaignVersionAsync(array $args = [])
 * @method \Aws\Result getCampaignVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCampaignVersionsAsync(array $args = [])
 * @method \Aws\Result getCampaigns(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getCampaignsAsync(array $args = [])
 * @method \Aws\Result getChannels(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getChannelsAsync(array $args = [])
 * @method \Aws\Result getEmailChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getEmailChannelAsync(array $args = [])
 * @method \Aws\Result getEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getEndpointAsync(array $args = [])
 * @method \Aws\Result getEventStream(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getEventStreamAsync(array $args = [])
 * @method \Aws\Result getExportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getExportJobAsync(array $args = [])
 * @method \Aws\Result getExportJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getExportJobsAsync(array $args = [])
 * @method \Aws\Result getGcmChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getGcmChannelAsync(array $args = [])
 * @method \Aws\Result getImportJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getImportJobAsync(array $args = [])
 * @method \Aws\Result getImportJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getImportJobsAsync(array $args = [])
 * @method \Aws\Result getSegment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSegmentAsync(array $args = [])
 * @method \Aws\Result getSegmentExportJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSegmentExportJobsAsync(array $args = [])
 * @method \Aws\Result getSegmentImportJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSegmentImportJobsAsync(array $args = [])
 * @method \Aws\Result getSegmentVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSegmentVersionAsync(array $args = [])
 * @method \Aws\Result getSegmentVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSegmentVersionsAsync(array $args = [])
 * @method \Aws\Result getSegments(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSegmentsAsync(array $args = [])
 * @method \Aws\Result getSmsChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSmsChannelAsync(array $args = [])
 * @method \Aws\Result getUserEndpoints(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getUserEndpointsAsync(array $args = [])
 * @method \Aws\Result getVoiceChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getVoiceChannelAsync(array $args = [])
 * @method \Aws\Result phoneNumberValidate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise phoneNumberValidateAsync(array $args = [])
 * @method \Aws\Result putEventStream(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putEventStreamAsync(array $args = [])
 * @method \Aws\Result putEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putEventsAsync(array $args = [])
 * @method \Aws\Result removeAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise removeAttributesAsync(array $args = [])
 * @method \Aws\Result sendMessages(array $args = [])
 * @method \GuzzleHttp\Promise\Promise sendMessagesAsync(array $args = [])
 * @method \Aws\Result sendUsersMessages(array $args = [])
 * @method \GuzzleHttp\Promise\Promise sendUsersMessagesAsync(array $args = [])
 * @method \Aws\Result updateAdmChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateAdmChannelAsync(array $args = [])
 * @method \Aws\Result updateApnsChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApnsChannelAsync(array $args = [])
 * @method \Aws\Result updateApnsSandboxChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApnsSandboxChannelAsync(array $args = [])
 * @method \Aws\Result updateApnsVoipChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApnsVoipChannelAsync(array $args = [])
 * @method \Aws\Result updateApnsVoipSandboxChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApnsVoipSandboxChannelAsync(array $args = [])
 * @method \Aws\Result updateApplicationSettings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateApplicationSettingsAsync(array $args = [])
 * @method \Aws\Result updateBaiduChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateBaiduChannelAsync(array $args = [])
 * @method \Aws\Result updateCampaign(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCampaignAsync(array $args = [])
 * @method \Aws\Result updateEmailChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateEmailChannelAsync(array $args = [])
 * @method \Aws\Result updateEndpoint(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateEndpointAsync(array $args = [])
 * @method \Aws\Result updateEndpointsBatch(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateEndpointsBatchAsync(array $args = [])
 * @method \Aws\Result updateGcmChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateGcmChannelAsync(array $args = [])
 * @method \Aws\Result updateSegment(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateSegmentAsync(array $args = [])
 * @method \Aws\Result updateSmsChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateSmsChannelAsync(array $args = [])
 * @method \Aws\Result updateVoiceChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateVoiceChannelAsync(array $args = [])
 */
class PinpointClient extends AwsClient
{
    private static $nameCollisionOverrides = [
        'GetUserEndpoint' => 'GetEndpoint',
        'GetUserEndpointAsync' => 'GetEndpointAsync',
        'UpdateUserEndpoint' => 'UpdateEndpoint',
        'UpdateUserEndpointAsync' => 'UpdateEndpointAsync',
        'UpdateUserEndpointsBatch' => 'UpdateEndpointsBatch',
        'UpdateUserEndpointsBatchAsync' => 'UpdateEndpointsBatchAsync',
    ];

    public function __call($name, array $args)
    {
        // Overcomes a naming collision with `AwsClient::getEndpoint`.
        if (isset(self::$nameCollisionOverrides[ucfirst($name)])) {
            $name = self::$nameCollisionOverrides[ucfirst($name)];
        }

        return parent::__call($name, $args);
    }

    /**
     * @internal
     * @codeCoverageIgnore
     */
    public static function applyDocFilters(array $api, array $docs)
    {
        foreach (self::$nameCollisionOverrides as $overrideName => $operationName) {
            if (substr($overrideName, -5) === 'Async') {
                continue;
            }
            // Overcomes a naming collision with `AwsClient::getEndpoint`.
            $api['operations'][$overrideName] = $api['operations'][$operationName];
            $docs['operations'][$overrideName] = $docs['operations'][$operationName];
            unset($api['operations'][$operationName], $docs['operations'][$operationName]);
        }
        ksort($api['operations']);

        return [
            new Service($api, ApiProvider::defaultProvider()),
            new DocModel($docs)
        ];
    }
}
