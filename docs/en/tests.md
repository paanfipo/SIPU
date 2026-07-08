# Functional Tests

| Code | Functionality | General Steps | Expected Result |
| --- | --- | --- | --- |
| RE001 | Create package | Log in as administrator, open package management and register a new package. | The package is registered and visible in the dynamic menu. |
| RE002 | Create module | Create a module and associate it with an existing package. | The module is associated with the selected package. |
| RE003 | Create base permissions | Save a new module and review the generated permissions. | The system generates listing, creation and update permissions. |
| RE004 | Generate base files | Run the base file generation flow for a module. | The system generates model, controller, view and base route files. |
| RE005 | Manage permissions | Create, query or update permissions from the administrative interface. | Permissions are available for role assignment. |
| RE007 | Manage roles | Create or update a role and assign permissions. | The role stores the selected permissions. |
| RE008 | Assign roles | Assign a role to a registered user. | The user obtains access according to the role permissions. |
| RE015 | Register user | Complete the registration of a new user. | The user is created and receives email verification when email is configured. |
| RE016 | Log in | Enter valid credentials. | The system authenticates the user and displays the corresponding dashboard. |
| RE017 | Recover password | Request password recovery from the login screen. | The user receives the password recovery email when email is configured. |
| RE021 | Use search | Search records from a list view. | The system filters results according to the entered criteria. |
| RE022 | List and sort | Open a record table and change the ordering. | Records are listed and sorted correctly. |
| RE024 | Receive notifications | Trigger an action that produces a notification. | The notification is registered for the corresponding user. |
| REQ001L | Create call | Register an entrepreneurship call with basic information. | The call is registered with associated stages. |
| REQ002L | Advance call | Execute the progression of a call between stages. | The call changes stage according to the defined rules. |
| REQ003L | Register participant | Enroll a participant in a call. | The participant is associated with the call. |
| REQ004L | Public registration | Complete the public registration form. | The public registration is stored in the system. |
| REQ008L | Assign schedule | Schedule an activity with date, time and responsible person. | The activity is scheduled with date, time and responsible person. |
| REQ009L | Track attendance | Register participant attendance for an activity. | The system records attendance and supports stage progression. |
| REQ010L | Manage updates | Submit an update or documentation associated with the process. | The system stores updates and documentation. |
