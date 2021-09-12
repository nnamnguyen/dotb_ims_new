<?php
// This file was auto-generated from sdk-root/src/data/discovery/2015-11-01/docs-2.json
return [ 'version' => '2.0', 'service' => '<fullname>AWS Application Discovery Service</fullname> <p>AWS Application Discovery Service helps you plan application migration projects by automatically identifying servers, virtual machines (VMs), software, and software dependencies running in your on-premises data centers. Application Discovery Service also collects application performance data, which can help you assess the outcome of your migration. The data collected by Application Discovery Service is securely retained in an AWS-hosted and managed database in the cloud. You can export the data as a CSV or XML file into your preferred visualization tool or cloud-migration solution to plan your migration. For more information, see <a href="http://aws.amazon.com/application-discovery/faqs/">AWS Application Discovery Service FAQ</a>.</p> <p>Application Discovery Service offers two modes of operation:</p> <ul> <li> <p> <b>Agentless discovery</b> mode is recommended for environments that use VMware vCenter Server. This mode doesn\'t require you to install an agent on each host. Agentless discovery gathers server information regardless of the operating systems, which minimizes the time required for initial on-premises infrastructure assessment. Agentless discovery doesn\'t collect information about software and software dependencies. It also doesn\'t work in non-VMware environments. </p> </li> <li> <p> <b>Agent-based discovery</b> mode collects a richer set of data than agentless discovery by using the AWS Application Discovery Agent, which you install on one or more hosts in your data center. The agent captures infrastructure and application information, including an inventory of installed software applications, system and process performance, resource utilization, and network dependencies between workloads. The information collected by agents is secured at rest and in transit to the Application Discovery Service database in the cloud. </p> </li> </ul> <p>We recommend that you use agent-based discovery for non-VMware environments and to collect information about software and software dependencies. You can also run agent-based and agentless discovery simultaneously. Use agentless discovery to quickly complete the initial infrastructure assessment and then install agents on select hosts.</p> <p>Application Discovery Service integrates with application discovery solutions from AWS Partner Network (APN) partners. Third-party application discovery tools can query Application Discovery Service and write to the Application Discovery Service database using a public API. You can then import the data into either a visualization tool or cloud-migration solution.</p> <important> <p>Application Discovery Service doesn\'t gather sensitive information. All data is handled according to the <a href="http://aws.amazon.com/privacy/">AWS Privacy Policy</a>. You can operate Application Discovery Service offline to inspect collected data before it is shared with the service.</p> </important> <p>Your AWS account must be granted access to Application Discovery Service, a process called <i>whitelisting</i>. This is true for AWS partners and customers alike. To request access, <a href="http://aws.amazon.com/application-discovery/">sign up for Application Discovery Service</a>. </p> <p>This API reference provides descriptions, syntax, and usage examples for each of the actions and data types for Application Discovery Service. The topic for each action shows the API request parameters and the response. Alternatively, you can use one of the AWS SDKs to access an API that is tailored to the programming language or platform that you\'re using. For more information, see <a href="http://aws.amazon.com/tools/#SDKs">AWS SDKs</a>.</p> <p>This guide is intended for use with the <a href="http://docs.aws.amazon.com/application-discovery/latest/userguide/"> <i>AWS Application Discovery Service User Guide</i> </a>.</p>', 'operations' => [ 'AssociateConfigurationItemsToApplication' => '<p>Associates one or more configuration items with an application.</p>', 'CreateApplication' => '<p>Creates an application with the given name and description.</p>', 'CreateTags' => '<p>Creates one or more tags for configuration items. Tags are metadata that help you categorize IT assets. This API accepts a list of multiple configuration items.</p>', 'DeleteApplications' => '<p>Deletes a list of applications and their associations with configuration items.</p>', 'DeleteTags' => '<p>Deletes the association between configuration items and one or more tags. This API accepts a list of multiple configuration items.</p>', 'DescribeAgents' => '<p>Lists agents or the Connector by ID or lists all agents/Connectors associated with your user account if you did not specify an ID.</p>', 'DescribeConfigurations' => '<p>Retrieves attributes for a list of configuration item IDs. All of the supplied IDs must be for the same asset type (server, application, process, or connection). Output fields are specific to the asset type selected. For example, the output for a <i>server</i> configuration item includes a list of attributes about the server, such as host name, operating system, and number of network cards.</p> <p>For a complete list of outputs for each asset type, see <a href="http://docs.aws.amazon.com/application-discovery/latest/APIReference/discovery-api-queries.html#DescribeConfigurations">Using the DescribeConfigurations Action</a>.</p>', 'DescribeExportConfigurations' => '<p>Deprecated. Use <code>DescribeExportTasks</code> instead.</p> <p>Retrieves the status of a given export process. You can retrieve status from a maximum of 100 processes.</p>', 'DescribeExportTasks' => '<p>Retrieve status of one or more export tasks. You can retrieve the status of up to 100 export tasks.</p>', 'DescribeTags' => '<p>Retrieves a list of configuration items that are tagged with a specific tag. Or retrieves a list of all tags assigned to a specific configuration item.</p>', 'DisassociateConfigurationItemsFromApplication' => '<p>Disassociates one or more configuration items from an application.</p>', 'ExportConfigurations' => '<p>Deprecated. Use <code>StartExportTask</code> instead.</p> <p>Exports all discovered configuration data to an Amazon S3 bucket or an application that enables you to view and evaluate the data. Data includes tags and tag associations, processes, connections, servers, and system performance. This API returns an export ID that you can query using the <i>DescribeExportConfigurations</i> API. The system imposes a limit of two configuration exports in six hours.</p>', 'GetDiscoverySummary' => '<p>Retrieves a short summary of discovered assets.</p>', 'ListConfigurations' => '<p>Retrieves a list of configuration items according to criteria that you specify in a filter. The filter criteria identifies the relationship requirements.</p>', 'ListServerNeighbors' => '<p>Retrieves a list of servers that are one network hop away from a specified server.</p>', 'StartDataCollectionByAgentIds' => '<p>Instructs the specified agents or connectors to start collecting data.</p>', 'StartExportTask' => '<p> Begins the export of discovered data to an S3 bucket.</p> <p> If you specify <code>agentIds</code> in a filter, the task exports up to 72 hours of detailed data collected by the identified Application Discovery Agent, including network, process, and performance details. A time range for exported agent data may be set by using <code>startTime</code> and <code>endTime</code>. Export of detailed agent data is limited to five concurrently running exports. </p> <p> If you do not include an <code>agentIds</code> filter, summary data is exported that includes both AWS Agentless Discovery Connector data and summary data from AWS Discovery Agents. Export of summary data is limited to two exports per day. </p>', 'StopDataCollectionByAgentIds' => '<p>Instructs the specified agents or connectors to stop collecting data.</p>', 'UpdateApplication' => '<p>Updates metadata about an application.</p>', ], 'shapes' => [ 'AgentConfigurationStatus' => [ 'base' => '<p>Information about agents or connectors that were instructed to start collecting data. Information includes the agent/connector ID, a description of the operation, and whether the agent/connector configuration was updated.</p>', 'refs' => [ 'AgentConfigurationStatusList$member' => NULL, ], ], 'AgentConfigurationStatusList' => [ 'base' => NULL, 'refs' => [ 'StartDataCollectionByAgentIdsResponse$agentsConfigurationStatus' => '<p>Information about agents or the connector that were instructed to start collecting data. Information includes the agent/connector ID, a description of the operation performed, and whether the agent/connector configuration was updated.</p>', 'StopDataCollectionByAgentIdsResponse$agentsConfigurationStatus' => '<p>Information about the agents or connector that were instructed to stop collecting data. Information includes the agent/connector ID, a description of the operation performed, and whether the agent/connector configuration was updated.</p>', ], ], 'AgentId' => [ 'base' => NULL, 'refs' => [ 'AgentIds$member' => NULL, 'AgentInfo$agentId' => '<p>The agent or connector ID.</p>', ], ], 'AgentIds' => [ 'base' => NULL, 'refs' => [ 'DescribeAgentsRequest$agentIds' => '<p>The agent or the Connector IDs for which you want information. If you specify no IDs, the system returns information about all agents/Connectors associated with your AWS user account.</p>', 'StartDataCollectionByAgentIdsRequest$agentIds' => '<p>The IDs of the agents or connectors from which to start collecting data. If you send a request to an agent/connector ID that you do not have permission to contact, according to your AWS account, the service does not throw an exception. Instead, it returns the error in the <i>Description</i> field. If you send a request to multiple agents/connectors and you do not have permission to contact some of those agents/connectors, the system does not throw an exception. Instead, the system shows <code>Failed</code> in the <i>Description</i> field.</p>', 'StopDataCollectionByAgentIdsRequest$agentIds' => '<p>The IDs of the agents or connectors from which to stop collecting data.</p>', ], ], 'AgentInfo' => [ 'base' => '<p>Information about agents or connectors associated with the user’s AWS account. Information includes agent or connector IDs, IP addresses, media access control (MAC) addresses, agent or connector health, hostname where the agent or connector resides, and agent version for each agent.</p>', 'refs' => [ 'AgentsInfo$member' => NULL, ], ], 'AgentNetworkInfo' => [ 'base' => '<p>Network details about the host where the agent/connector resides.</p>', 'refs' => [ 'AgentNetworkInfoList$member' => NULL, ], ], 'AgentNetworkInfoList' => [ 'base' => NULL, 'refs' => [ 'AgentInfo$agentNetworkInfoList' => '<p>Network details about the host where the agent or connector resides.</p>', ], ], 'AgentStatus' => [ 'base' => NULL, 'refs' => [ 'AgentInfo$health' => '<p>The health of the agent or connector.</p>', ], ], 'AgentsInfo' => [ 'base' => NULL, 'refs' => [ 'DescribeAgentsResponse$agentsInfo' => '<p>Lists agents or the Connector by ID or lists all agents/Connectors associated with your user account if you did not specify an agent/Connector ID. The output includes agent/Connector IDs, IP addresses, media access control (MAC) addresses, agent/Connector health, host name where the agent/Connector resides, and the version number of each agent/Connector.</p>', ], ], 'ApplicationId' => [ 'base' => NULL, 'refs' => [ 'ApplicationIdsList$member' => NULL, 'AssociateConfigurationItemsToApplicationRequest$applicationConfigurationId' => '<p>The configuration ID of an application with which items are to be associated.</p>', 'DisassociateConfigurationItemsFromApplicationRequest$applicationConfigurationId' => '<p>Configuration ID of an application from which each item is disassociated.</p>', 'UpdateApplicationRequest$configurationId' => '<p>Configuration ID of the application to be updated.</p>', ], ], 'ApplicationIdsList' => [ 'base' => NULL, 'refs' => [ 'DeleteApplicationsRequest$configurationIds' => '<p>Configuration ID of an application to be deleted.</p>', ], ], 'AssociateConfigurationItemsToApplicationRequest' => [ 'base' => NULL, 'refs' => [], ], 'AssociateConfigurationItemsToApplicationResponse' => [ 'base' => NULL, 'refs' => [], ], 'AuthorizationErrorException' => [ 'base' => '<p>The AWS user account does not have permission to perform the action. Check the IAM policy associated with this account.</p>', 'refs' => [], ], 'Boolean' => [ 'base' => NULL, 'refs' => [ 'AgentConfigurationStatus$operationSucceeded' => '<p>Information about the status of the <code>StartDataCollection</code> and <code>StopDataCollection</code> operations. The system has recorded the data collection operation. The agent/connector receives this command the next time it polls for a new command. </p>', 'ExportInfo$isTruncated' => '<p>If true, the export of agent information exceeded the size limit for a single export and the exported data is incomplete for the requested time range. To address this, select a smaller time range for the export by using <code>startDate</code> and <code>endDate</code>.</p>', 'ListServerNeighborsRequest$portInformationNeeded' => '<p>Flag to indicate if port and protocol information is needed as part of the response.</p>', ], ], 'BoxedInteger' => [ 'base' => NULL, 'refs' => [ 'NeighborConnectionDetail$destinationPort' => '<p>The destination network port for the connection.</p>', ], ], 'Condition' => [ 'base' => NULL, 'refs' => [ 'ExportFilter$condition' => '<p>Supported condition: <code>EQUALS</code> </p>', 'Filter$condition' => '<p>A conditional operator. The following operators are valid: EQUALS, NOT_EQUALS, CONTAINS, NOT_CONTAINS. If you specify multiple filters, the system utilizes all filters as though concatenated by <i>AND</i>. If you specify multiple values for a particular filter, the system differentiates the values using <i>OR</i>. Calling either <i>DescribeConfigurations</i> or <i>ListConfigurations</i> returns attributes of matching configuration items.</p>', ], ], 'Configuration' => [ 'base' => NULL, 'refs' => [ 'Configurations$member' => NULL, ], ], 'ConfigurationId' => [ 'base' => NULL, 'refs' => [ 'ConfigurationIdList$member' => NULL, 'ConfigurationTag$configurationId' => '<p>The configuration ID for the item to tag. You can specify a list of keys and values.</p>', 'ListServerNeighborsRequest$configurationId' => '<p>Configuration ID of the server for which neighbors are being listed.</p>', 'NeighborConnectionDetail$sourceServerId' => '<p>The ID of the server that opened the network connection.</p>', 'NeighborConnectionDetail$destinationServerId' => '<p>The ID of the server that accepted the network connection.</p>', ], ], 'ConfigurationIdList' => [ 'base' => NULL, 'refs' => [ 'AssociateConfigurationItemsToApplicationRequest$configurationIds' => '<p>The ID of each configuration item to be associated with an application.</p>', 'CreateTagsRequest$configurationIds' => '<p>A list of configuration items that you want to tag.</p>', 'DeleteTagsRequest$configurationIds' => '<p>A list of configuration items with tags that you want to delete.</p>', 'DescribeConfigurationsRequest$configurationIds' => '<p>One or more configuration IDs.</p>', 'DisassociateConfigurationItemsFromApplicationRequest$configurationIds' => '<p>Configuration ID of each item to be disassociated from an application.</p>', 'ListServerNeighborsRequest$neighborConfigurationIds' => '<p>List of configuration IDs to test for one-hop-away.</p>', ], ], 'ConfigurationItemType' => [ 'base' => NULL, 'refs' => [ 'ConfigurationTag$configurationType' => '<p>A type of IT asset to tag.</p>', 'ListConfigurationsRequest$configurationType' => '<p>A valid configuration identified by Application Discovery Service. </p>', ], ], 'ConfigurationTag' => [ 'base' => '<p>Tags for a configuration item. Tags are metadata that help you categorize IT assets.</p>', 'refs' => [ 'ConfigurationTagSet$member' => NULL, ], ], 'ConfigurationTagSet' => [ 'base' => NULL, 'refs' => [ 'DescribeTagsResponse$tags' => '<p>Depending on the input, this is a list of configuration items tagged with a specific tag, or a list of tags for a specific configuration item.</p>', ], ], 'Configurations' => [ 'base' => NULL, 'refs' => [ 'ListConfigurationsResponse$configurations' => '<p>Returns configuration details, including the configuration ID, attribute names, and attribute values.</p>', ], ], 'ConfigurationsDownloadUrl' => [ 'base' => NULL, 'refs' => [ 'ExportInfo$configurationsDownloadUrl' => '<p>A URL for an Amazon S3 bucket where you can review the exported data. The URL is displayed only if the export succeeded.</p>', ], ], 'ConfigurationsExportId' => [ 'base' => NULL, 'refs' => [ 'ExportConfigurationsResponse$exportId' => '<p>A unique identifier that you can use to query the export status.</p>', 'ExportIds$member' => NULL, 'ExportInfo$exportId' => '<p>A unique identifier used to query an export.</p>', 'StartExportTaskResponse$exportId' => '<p>A unique identifier used to query the status of an export request.</p>', ], ], 'CreateApplicationRequest' => [ 'base' => NULL, 'refs' => [], ], 'CreateApplicationResponse' => [ 'base' => NULL, 'refs' => [], ], 'CreateTagsRequest' => [ 'base' => NULL, 'refs' => [], ], 'CreateTagsResponse' => [ 'base' => NULL, 'refs' => [], ], 'CustomerAgentInfo' => [ 'base' => '<p>Inventory data for installed discovery agents.</p>', 'refs' => [ 'GetDiscoverySummaryResponse$agentSummary' => '<p>Details about discovered agents, including agent status and health.</p>', ], ], 'CustomerConnectorInfo' => [ 'base' => '<p>Inventory data for installed discovery connectors.</p>', 'refs' => [ 'GetDiscoverySummaryResponse$connectorSummary' => '<p>Details about discovered connectors, including connector status and health.</p>', ], ], 'DeleteApplicationsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DeleteApplicationsResponse' => [ 'base' => NULL, 'refs' => [], ], 'DeleteTagsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DeleteTagsResponse' => [ 'base' => NULL, 'refs' => [], ], 'DescribeAgentsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeAgentsResponse' => [ 'base' => NULL, 'refs' => [], ], 'DescribeConfigurationsAttribute' => [ 'base' => NULL, 'refs' => [ 'DescribeConfigurationsAttributes$member' => NULL, ], ], 'DescribeConfigurationsAttributes' => [ 'base' => NULL, 'refs' => [ 'DescribeConfigurationsResponse$configurations' => '<p>A key in the response map. The value is an array of data.</p>', ], ], 'DescribeConfigurationsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeConfigurationsResponse' => [ 'base' => NULL, 'refs' => [], ], 'DescribeExportConfigurationsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeExportConfigurationsResponse' => [ 'base' => NULL, 'refs' => [], ], 'DescribeExportTasksRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeExportTasksResponse' => [ 'base' => NULL, 'refs' => [], ], 'DescribeTagsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeTagsResponse' => [ 'base' => NULL, 'refs' => [], ], 'DisassociateConfigurationItemsFromApplicationRequest' => [ 'base' => NULL, 'refs' => [], ], 'DisassociateConfigurationItemsFromApplicationResponse' => [ 'base' => NULL, 'refs' => [], ], 'ExportConfigurationsResponse' => [ 'base' => NULL, 'refs' => [], ], 'ExportDataFormat' => [ 'base' => NULL, 'refs' => [ 'ExportDataFormats$member' => NULL, ], ], 'ExportDataFormats' => [ 'base' => NULL, 'refs' => [ 'StartExportTaskRequest$exportDataFormat' => '<p>The file format for the returned export data. Default value is <code>CSV</code>. <b>Note:</b> <i>The</i> <code>GRAPHML</code> <i>option has been deprecated.</i> </p>', ], ], 'ExportFilter' => [ 'base' => '<p>Used to select which agent\'s data is to be exported. A single agent ID may be selected for export using the <a href="http://docs.aws.amazon.com/application-discovery/latest/APIReference/API_StartExportTask.html">StartExportTask</a> action.</p>', 'refs' => [ 'ExportFilters$member' => NULL, ], ], 'ExportFilters' => [ 'base' => NULL, 'refs' => [ 'DescribeExportTasksRequest$filters' => '<p>One or more filters.</p> <ul> <li> <p> <code>AgentId</code> - ID of the agent whose collected data will be exported</p> </li> </ul>', 'StartExportTaskRequest$filters' => '<p>If a filter is present, it selects the single <code>agentId</code> of the Application Discovery Agent for which data is exported. The <code>agentId</code> can be found in the results of the <code>DescribeAgents</code> API or CLI. If no filter is present, <code>startTime</code> and <code>endTime</code> are ignored and exported data includes both Agentless Discovery Connector data and summary data from Application Discovery agents. </p>', ], ], 'ExportIds' => [ 'base' => NULL, 'refs' => [ 'DescribeExportConfigurationsRequest$exportIds' => '<p>A unique identifier that you can use to query the export status.</p>', 'DescribeExportTasksRequest$exportIds' => '<p>One or more unique identifiers used to query the status of an export request.</p>', ], ], 'ExportInfo' => [ 'base' => '<p>Information regarding the export status of discovered data. The value is an array of objects.</p>', 'refs' => [ 'ExportsInfo$member' => NULL, ], ], 'ExportRequestTime' => [ 'base' => NULL, 'refs' => [ 'ExportInfo$exportRequestTime' => '<p>The time that the data export was initiated.</p>', ], ], 'ExportStatus' => [ 'base' => NULL, 'refs' => [ 'ExportInfo$exportStatus' => '<p>The status of the data export job.</p>', ], ], 'ExportStatusMessage' => [ 'base' => NULL, 'refs' => [ 'ExportInfo$statusMessage' => '<p>A status message provided for API callers.</p>', ], ], 'ExportsInfo' => [ 'base' => NULL, 'refs' => [ 'DescribeExportConfigurationsResponse$exportsInfo' => '<p>Returns export details. When the status is complete, the response includes a URL for an Amazon S3 bucket where you can view the data in a CSV file.</p>', 'DescribeExportTasksResponse$exportsInfo' => '<p>Contains one or more sets of export request details. When the status of a request is <code>SUCCEEDED</code>, the response includes a URL for an Amazon S3 bucket where you can view the data in a CSV file.</p>', ], ], 'Filter' => [ 'base' => '<p>A filter that can use conditional operators.</p> <p>For more information about filters, see <a href="http://docs.aws.amazon.com/application-discovery/latest/APIReference/discovery-api-queries.html">Querying Discovered Configuration Items</a>. </p>', 'refs' => [ 'Filters$member' => NULL, ], ], 'FilterName' => [ 'base' => NULL, 'refs' => [ 'ExportFilter$name' => '<p>A single <code>ExportFilter</code> name. Supported filters: <code>agentId</code>.</p>', 'TagFilter$name' => '<p>A name of the tag filter.</p>', ], ], 'FilterValue' => [ 'base' => NULL, 'refs' => [ 'FilterValues$member' => NULL, ], ], 'FilterValues' => [ 'base' => NULL, 'refs' => [ 'ExportFilter$values' => '<p>A single <code>agentId</code> for a Discovery Agent. An <code>agentId</code> can be found using the <a href="http://docs.aws.amazon.com/application-discovery/latest/APIReference/API_DescribeExportTasks.html">DescribeAgents</a> action. Typically an ADS <code>agentId</code> is in the form <code>o-0123456789abcdef0</code>.</p>', 'Filter$values' => '<p>A string value on which to filter. For example, if you choose the <code>destinationServer.osVersion</code> filter name, you could specify <code>Ubuntu</code> for the value.</p>', 'TagFilter$values' => '<p>Values for the tag filter.</p>', ], ], 'Filters' => [ 'base' => NULL, 'refs' => [ 'DescribeAgentsRequest$filters' => '<p>You can filter the request using various logical operators and a <i>key</i>-<i>value</i> format. For example: </p> <p> <code>{"key": "collectionStatus", "value": "STARTED"}</code> </p>', 'ListConfigurationsRequest$filters' => '<p>You can filter the request using various logical operators and a <i>key</i>-<i>value</i> format. For example: </p> <p> <code>{"key": "serverType", "value": "webServer"}</code> </p> <p>For a complete list of filter options and guidance about using them with this action, see <a href="http://docs.aws.amazon.com/application-discovery/latest/APIReference/discovery-api-queries.html#ListConfigurations">Querying Discovered Configuration Items</a>. </p>', ], ], 'GetDiscoverySummaryRequest' => [ 'base' => NULL, 'refs' => [], ], 'GetDiscoverySummaryResponse' => [ 'base' => NULL, 'refs' => [], ], 'Integer' => [ 'base' => NULL, 'refs' => [ 'CustomerAgentInfo$activeAgents' => '<p>Number of active discovery agents.</p>', 'CustomerAgentInfo$healthyAgents' => '<p>Number of healthy discovery agents</p>', 'CustomerAgentInfo$blackListedAgents' => '<p>Number of blacklisted discovery agents.</p>', 'CustomerAgentInfo$shutdownAgents' => '<p>Number of discovery agents with status SHUTDOWN.</p>', 'CustomerAgentInfo$unhealthyAgents' => '<p>Number of unhealthy discovery agents.</p>', 'CustomerAgentInfo$totalAgents' => '<p>Total number of discovery agents.</p>', 'CustomerAgentInfo$unknownAgents' => '<p>Number of unknown discovery agents.</p>', 'CustomerConnectorInfo$activeConnectors' => '<p>Number of active discovery connectors.</p>', 'CustomerConnectorInfo$healthyConnectors' => '<p>Number of healthy discovery connectors.</p>', 'CustomerConnectorInfo$blackListedConnectors' => '<p>Number of blacklisted discovery connectors.</p>', 'CustomerConnectorInfo$shutdownConnectors' => '<p>Number of discovery connectors with status SHUTDOWN,</p>', 'CustomerConnectorInfo$unhealthyConnectors' => '<p>Number of unhealthy discovery connectors.</p>', 'CustomerConnectorInfo$totalConnectors' => '<p>Total number of discovery connectors.</p>', 'CustomerConnectorInfo$unknownConnectors' => '<p>Number of unknown discovery connectors.</p>', 'DescribeAgentsRequest$maxResults' => '<p>The total number of agents/Connectors to return in a single page of output. The maximum value is 100.</p>', 'DescribeExportConfigurationsRequest$maxResults' => '<p>The maximum number of results that you want to display as a part of the query.</p>', 'DescribeExportTasksRequest$maxResults' => '<p>The maximum number of volume results returned by <code>DescribeExportTasks</code> in paginated output. When this parameter is used, <code>DescribeExportTasks</code> only returns <code>maxResults</code> results in a single page along with a <code>nextToken</code> response element.</p>', 'DescribeTagsRequest$maxResults' => '<p>The total number of items to return in a single page of output. The maximum value is 100.</p>', 'ListConfigurationsRequest$maxResults' => '<p>The total number of items to return. The maximum value is 100.</p>', 'ListServerNeighborsRequest$maxResults' => '<p>Maximum number of results to return in a single page of output.</p>', ], ], 'InvalidParameterException' => [ 'base' => '<p>One or more parameters are not valid. Verify the parameters and try again.</p>', 'refs' => [], ], 'InvalidParameterValueException' => [ 'base' => '<p>The value of one or more parameters are either invalid or out of range. Verify the parameter values and try again.</p>', 'refs' => [], ], 'ListConfigurationsRequest' => [ 'base' => NULL, 'refs' => [], ], 'ListConfigurationsResponse' => [ 'base' => NULL, 'refs' => [], ], 'ListServerNeighborsRequest' => [ 'base' => NULL, 'refs' => [], ], 'ListServerNeighborsResponse' => [ 'base' => NULL, 'refs' => [], ], 'Long' => [ 'base' => NULL, 'refs' => [ 'GetDiscoverySummaryResponse$servers' => '<p>The number of servers discovered.</p>', 'GetDiscoverySummaryResponse$applications' => '<p>The number of applications discovered.</p>', 'GetDiscoverySummaryResponse$serversMappedToApplications' => '<p>The number of servers mapped to applications.</p>', 'GetDiscoverySummaryResponse$serversMappedtoTags' => '<p>The number of servers mapped to tags.</p>', 'ListServerNeighborsResponse$knownDependencyCount' => '<p>Count of distinct servers that are one hop away from the given server.</p>', 'NeighborConnectionDetail$connectionsCount' => '<p>The number of open network connections with the neighboring server.</p>', ], ], 'Message' => [ 'base' => NULL, 'refs' => [ 'AuthorizationErrorException$message' => NULL, 'InvalidParameterException$message' => NULL, 'InvalidParameterValueException$message' => NULL, 'OperationNotPermittedException$message' => NULL, 'ResourceNotFoundException$message' => NULL, 'ServerInternalErrorException$message' => NULL, ], ], 'NeighborConnectionDetail' => [ 'base' => '<p>Details about neighboring servers.</p>', 'refs' => [ 'NeighborDetailsList$member' => NULL, ], ], 'NeighborDetailsList' => [ 'base' => NULL, 'refs' => [ 'ListServerNeighborsResponse$neighbors' => '<p>List of distinct servers that are one hop away from the given server.</p>', ], ], 'NextToken' => [ 'base' => NULL, 'refs' => [ 'DescribeAgentsRequest$nextToken' => '<p>Token to retrieve the next set of results. For example, if you previously specified 100 IDs for <code>DescribeAgentsRequest$agentIds</code> but set <code>DescribeAgentsRequest$maxResults</code> to 10, you received a set of 10 results along with a token. Use that token in this query to get the next set of 10.</p>', 'DescribeAgentsResponse$nextToken' => '<p>Token to retrieve the next set of results. For example, if you specified 100 IDs for <code>DescribeAgentsRequest$agentIds</code> but set <code>DescribeAgentsRequest$maxResults</code> to 10, you received a set of 10 results along with this token. Use this token in the next query to retrieve the next set of 10.</p>', 'DescribeExportConfigurationsRequest$nextToken' => '<p>A token to get the next set of results. For example, if you specify 100 IDs for <code>DescribeExportConfigurationsRequest$exportIds</code> but set <code>DescribeExportConfigurationsRequest$maxResults</code> to 10, you get results in a set of 10. Use the token in the query to get the next set of 10.</p>', 'DescribeExportConfigurationsResponse$nextToken' => '<p>A token to get the next set of results. For example, if you specify 100 IDs for <code>DescribeExportConfigurationsRequest$exportIds</code> but set <code>DescribeExportConfigurationsRequest$maxResults</code> to 10, you get results in a set of 10. Use the token in the query to get the next set of 10.</p>', 'DescribeExportTasksRequest$nextToken' => '<p>The <code>nextToken</code> value returned from a previous paginated <code>DescribeExportTasks</code> request where <code>maxResults</code> was used and the results exceeded the value of that parameter. Pagination continues from the end of the previous results that returned the <code>nextToken</code> value. This value is null when there are no more results to return.</p>', 'DescribeExportTasksResponse$nextToken' => '<p>The <code>nextToken</code> value to include in a future <code>DescribeExportTasks</code> request. When the results of a <code>DescribeExportTasks</code> request exceed <code>maxResults</code>, this value can be used to retrieve the next page of results. This value is null when there are no more results to return.</p>', 'DescribeTagsRequest$nextToken' => '<p>A token to start the list. Use this token to get the next set of results.</p>', 'DescribeTagsResponse$nextToken' => '<p>The call returns a token. Use this token to get the next set of results.</p>', 'ListConfigurationsRequest$nextToken' => '<p>Token to retrieve the next set of results. For example, if a previous call to ListConfigurations returned 100 items, but you set <code>ListConfigurationsRequest$maxResults</code> to 10, you received a set of 10 results along with a token. Use that token in this query to get the next set of 10.</p>', 'ListConfigurationsResponse$nextToken' => '<p>Token to retrieve the next set of results. For example, if your call to ListConfigurations returned 100 items, but you set <code>ListConfigurationsRequest$maxResults</code> to 10, you received a set of 10 results along with this token. Use this token in the next query to retrieve the next set of 10.</p>', ], ], 'OperationNotPermittedException' => [ 'base' => '<p>This operation is not permitted.</p>', 'refs' => [], ], 'OrderByElement' => [ 'base' => '<p>A field and direction for ordered output.</p>', 'refs' => [ 'OrderByList$member' => NULL, ], ], 'OrderByList' => [ 'base' => NULL, 'refs' => [ 'ListConfigurationsRequest$orderBy' => '<p>Certain filter criteria return output that can be sorted in ascending or descending order. For a list of output characteristics for each filter, see <a href="http://docs.aws.amazon.com/application-discovery/latest/APIReference/discovery-api-queries.html#ListConfigurations">Using the ListConfigurations Action</a>.</p>', ], ], 'ResourceNotFoundException' => [ 'base' => '<p>The specified configuration ID was not located. Verify the configuration ID and try again.</p>', 'refs' => [], ], 'ServerInternalErrorException' => [ 'base' => '<p>The server experienced an internal error. Try again.</p>', 'refs' => [], ], 'StartDataCollectionByAgentIdsRequest' => [ 'base' => NULL, 'refs' => [], ], 'StartDataCollectionByAgentIdsResponse' => [ 'base' => NULL, 'refs' => [], ], 'StartExportTaskRequest' => [ 'base' => NULL, 'refs' => [], ], 'StartExportTaskResponse' => [ 'base' => NULL, 'refs' => [], ], 'StopDataCollectionByAgentIdsRequest' => [ 'base' => NULL, 'refs' => [], ], 'StopDataCollectionByAgentIdsResponse' => [ 'base' => NULL, 'refs' => [], ], 'String' => [ 'base' => NULL, 'refs' => [ 'AgentConfigurationStatus$agentId' => '<p>The agent/connector ID.</p>', 'AgentConfigurationStatus$description' => '<p>A description of the operation performed.</p>', 'AgentInfo$hostName' => '<p>The name of the host where the agent or connector resides. The host can be a server or virtual machine.</p>', 'AgentInfo$connectorId' => '<p>The ID of the connector.</p>', 'AgentInfo$version' => '<p>The agent or connector version.</p>', 'AgentInfo$lastHealthPingTime' => '<p>Time since agent or connector health was reported.</p>', 'AgentInfo$collectionStatus' => '<p>Status of the collection process for an agent or connector.</p>', 'AgentInfo$agentType' => '<p>Type of agent.</p>', 'AgentInfo$registeredTime' => '<p>Agent\'s first registration timestamp in UTC.</p>', 'AgentNetworkInfo$ipAddress' => '<p>The IP address for the host where the agent/connector resides.</p>', 'AgentNetworkInfo$macAddress' => '<p>The MAC address for the host where the agent/connector resides.</p>', 'Configuration$key' => NULL, 'Configuration$value' => NULL, 'CreateApplicationRequest$name' => '<p>Name of the application to be created.</p>', 'CreateApplicationRequest$description' => '<p>Description of the application to be created.</p>', 'CreateApplicationResponse$configurationId' => '<p>Configuration ID of an application to be created.</p>', 'DescribeConfigurationsAttribute$key' => NULL, 'DescribeConfigurationsAttribute$value' => NULL, 'Filter$name' => '<p>The name of the filter.</p>', 'ListServerNeighborsRequest$nextToken' => '<p>Token to retrieve the next set of results. For example, if you previously specified 100 IDs for <code>ListServerNeighborsRequest$neighborConfigurationIds</code> but set <code>ListServerNeighborsRequest$maxResults</code> to 10, you received a set of 10 results along with a token. Use that token in this query to get the next set of 10.</p>', 'ListServerNeighborsResponse$nextToken' => '<p>Token to retrieve the next set of results. For example, if you specified 100 IDs for <code>ListServerNeighborsRequest$neighborConfigurationIds</code> but set <code>ListServerNeighborsRequest$maxResults</code> to 10, you received a set of 10 results along with this token. Use this token in the next query to retrieve the next set of 10.</p>', 'NeighborConnectionDetail$transportProtocol' => '<p>The network protocol used for the connection.</p>', 'OrderByElement$fieldName' => '<p>The field on which to order.</p>', 'UpdateApplicationRequest$name' => '<p>New name of the application to be updated.</p>', 'UpdateApplicationRequest$description' => '<p>New description of the application to be updated.</p>', ], ], 'Tag' => [ 'base' => '<p>Metadata that help you categorize IT assets.</p>', 'refs' => [ 'TagSet$member' => NULL, ], ], 'TagFilter' => [ 'base' => '<p>The tag filter. Valid names are: <code>tagKey</code>, <code>tagValue</code>, <code>configurationId</code>.</p>', 'refs' => [ 'TagFilters$member' => NULL, ], ], 'TagFilters' => [ 'base' => NULL, 'refs' => [ 'DescribeTagsRequest$filters' => '<p>You can filter the list using a <i>key</i>-<i>value</i> format. You can separate these items by using logical operators. Allowed filters include <code>tagKey</code>, <code>tagValue</code>, and <code>configurationId</code>. </p>', ], ], 'TagKey' => [ 'base' => NULL, 'refs' => [ 'ConfigurationTag$key' => '<p>A type of tag on which to filter. For example, <i>serverType</i>.</p>', 'Tag$key' => '<p>The type of tag on which to filter.</p>', ], ], 'TagSet' => [ 'base' => NULL, 'refs' => [ 'CreateTagsRequest$tags' => '<p>Tags that you want to associate with one or more configuration items. Specify the tags that you want to create in a <i>key</i>-<i>value</i> format. For example:</p> <p> <code>{"key": "serverType", "value": "webServer"}</code> </p>', 'DeleteTagsRequest$tags' => '<p>Tags that you want to delete from one or more configuration items. Specify the tags that you want to delete in a <i>key</i>-<i>value</i> format. For example:</p> <p> <code>{"key": "serverType", "value": "webServer"}</code> </p>', ], ], 'TagValue' => [ 'base' => NULL, 'refs' => [ 'ConfigurationTag$value' => '<p>A value on which to filter. For example <i>key = serverType</i> and <i>value = web server</i>.</p>', 'Tag$value' => '<p>A value for a tag key on which to filter.</p>', ], ], 'TimeStamp' => [ 'base' => NULL, 'refs' => [ 'ConfigurationTag$timeOfCreation' => '<p>The time the configuration tag was created in Coordinated Universal Time (UTC).</p>', 'ExportInfo$requestedStartTime' => '<p>The value of <code>startTime</code> parameter in the <code>StartExportTask</code> request. If no <code>startTime</code> was requested, this result does not appear in <code>ExportInfo</code>.</p>', 'ExportInfo$requestedEndTime' => '<p>The <code>endTime</code> used in the <code>StartExportTask</code> request. If no <code>endTime</code> was requested, this result does not appear in <code>ExportInfo</code>.</p>', 'StartExportTaskRequest$startTime' => '<p>The start timestamp for exported data from the single Application Discovery Agent selected in the filters. If no value is specified, data is exported starting from the first data collected by the agent.</p>', 'StartExportTaskRequest$endTime' => '<p>The end timestamp for exported data from the single Application Discovery Agent selected in the filters. If no value is specified, exported data includes the most recent data collected by the agent.</p>', ], ], 'UpdateApplicationRequest' => [ 'base' => NULL, 'refs' => [], ], 'UpdateApplicationResponse' => [ 'base' => NULL, 'refs' => [], ], 'orderString' => [ 'base' => NULL, 'refs' => [ 'OrderByElement$sortOrder' => '<p>Ordering direction.</p>', ], ], ],];