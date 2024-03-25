<style>
    .justify{ text-align:justify; }
    .accordion-body ol{ list-style-type:upper-roman!important; padding-left: 25px; }
    .accordion-body ul{ list-style-type:circle!important; padding-left: 25px; }
</style>
<div class="page-wrapper px-4 mt-4">
    <div class="accordion accordion-flush my-3" id="accordionGuide">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <img src="<?= base_url('assets/img/icons/purchase1.svg'); ?>" alt="img">&emsp;Form Setups
            </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionGuide">
                <div class="accordion-body">
                    <p>In the Form Setup section of REMS, you can initially configure essential components such as Designations, Geolocations, Projects, and Payment Plans. These setups are pivotal within REMS, laying the foundation for streamlined management and organization of real estate data.</p>
                    <ol>
                        <li>
                            <strong>Designations Configuration:</strong>
                            <p>Users can define various roles and designations within the system, assigning specific responsibilities and access levels to individuals or teams.</p>
                        </li>
                        <li>
                            <strong>Geolocations Setup:</strong>
                            <p>This feature allows users to establish geographical locations relevant to their real estate operations, including regions, cities, or specific areas etc.</p>
                        </li>
                        <li>
                            <strong>Projects Management:</strong>
                            <p>REMS empowers users to create and manage projects seamlessly, encompassing diverse real estate ventures such as residential developments, commercial complexes, or infrastructure projects.</p>
                        </li>
                        <li>
                            <strong>Payment Plans Configuration:</strong>
                            <p>Users can configure customizable payment plans tailored to the unique requirements of individual projects or properties.<br>Payment plans feature flexible options such as installment schedules, down payment percentages, and financing terms, catering to diverse client needs.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img">&emsp;Agents
            </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionGuide">
                <div class="accordion-body">
                    <strong>Agent Section:</strong>
                    <ol>
                        <li>In the Agent section, you can input all necessary information about the agent.</li>
                        <li>This includes details such as name, employee code,  CNIC, contact and other important onformation.</li>
                        <li>Having this information readily available ensures smooth booking processes.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                <img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img">&emsp;Customers
            </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionGuide">
                <div class="accordion-body">
                    <ol>
                        <li>
                            <strong>Customer Information:</strong>
                                The system allows users to input mandatory information about customers, including:
                            <ul>
                                <li>Name: Full name of the customer.</li>
                                <li>Contact: Contact details such as phone number and email address.</li>
                                <li>CNIC (Computerized National Identity Card): Essential for booking and installment purposes. It serves as a unique identifier for each customer.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Importance of CNIC:</strong>
                            <ul>
                                <li>CNIC entry is crucial as it serves as the primary identifier for customers within the system.</li>
                                <li>It enables functionalities such as booking confirmation, installment tracking, and legal documentation.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Live Image Capture:</strong>
                            <ul>
                                <li>Within this section, users can capture live images of customers for verification and identification purposes.</li>
                                <li>This feature enhances security and ensures the authenticity of customer records.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                <img src="<?= base_url('assets/img/icons/places.svg'); ?>" alt="img">&emsp;Bookings
            </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionGuide">
                <div class="accordion-body">
                    <strong>Booking Section:</strong><br>
                    You can add bookings for any customer. It is crucial to fill in information accurately to avoid any mistakes in the amount.<br>
                    <strong>Generate Letters:</strong>
                    <ul>
                        <li>Booking Memo</li>
                        <li>Welcome Letter</li>
                        <li>Confirmation Letter</li>
                        <li>Booking Form</li>
                        <li>Payment Plan</li>
                    </ul>
                    <strong>Issuing Booking File:</strong><br>
                    You can issue booking file directly from the system.<br>
                    <strong>Summary and Account Statement:</strong><br>
                    You can view a complete summary of bookings as well as the account statement for each booking.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                <img src="<?= base_url('assets/img/icons/expense1.svg'); ?>" alt="img">&emsp;Installments
            </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionGuide">
                <div class="accordion-body">
                    <ul>
                        <li>You can submit installments against their membership number.</li>
                        <li>You can view all installments associated with their membership.</li>
                        <li>You have the capability to print receipts for any installment submission.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                <img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img">&emsp;User Management
            </button>
            </h2>
            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionGuide">
                <div class="accordion-body">
                    <strong>User Management:</strong>
                    <ul>
                        <li>The system allows administrators to create and manage different users.</li>
                        <li>You can be assigned various permissions according to their roles and responsibilities within the system.</li>
                    </ul>
                    <strong>User Creation:</strong>
                    <ul>
                        <li>Administrators have the authority to create new users.</li>
                        <li>Each user can be assigned a unique username and password for authentication purposes.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <center class="my-4">
        <h4>Still Have Question?</h4>
            <p class="text-muted">If you cannot find answer to your  question in our guidline, you can always<br>contact us. We will answer shortly!</p>
    </center>
</div>