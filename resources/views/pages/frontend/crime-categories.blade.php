@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header text-center text-uppercase">Types of crime</div>
            <div class="card-body">
                <ol class="crimes">
                    <li>
                        Arson fires: Deliberately putting one’s property such a building, motor vehicle, etc. on fire is
                        called arson fires.
                    </li>

                    <li>Assault: Illegally attacking an individual with weapons like gun, knife, etc. in a severe manner is
                        called assault. Assault results in severe injury. Domestic or family violence also involves assault.
                    </li>

                    <li>Automobile theft: Unlawful theft or attempted theft of a motor vehicle.</li>

                    <li>Burglary: Illegally entering into a property and committing theft is called burglary.</li>

                    <li>Computer crime: Cyber-crime is an act of crime that involves computer and a network. The computer
                        may have been used in the commission of a crime, or it may be the target. Net crime refers to
                        criminal exploitation of the internet. Examples of the computer crime include cyber terrorism, cyber
                        warfare, harassment on the internet, spam, internet fraud, etc.</li>

                    <li>Corruption: is the use of power by government officials for illegal private gain. It includes
                        bribery, embezzlement, etc.</li>

                    <li>Disorderly conduct: This is the acting in a manner potentially threatening oneself or other people.
                    </li>

                    <li>Driving under influence of drinks and drugs: Driving under the influence of alcohol or drugs may
                        prove threatening to the individual as well as the public. Constant checks are conducted by police
                        officials in whom the alcohol testing devices are used.</li>

                    <li>Embezzlement: Misusing money or property of an organization for an individual’s personal use.</li>

                    <li>Fraud: Deception of one party by another party for personal or financial gain is called fraud.</li>

                    <li>Homicide: Unlawfully killing an individual is called homicide or murder.</li>

                    <li>Identity theft: Unlawfully using a person’s social security number, credit card number, etc. for
                        financial gain is termed as identity theft.</li>

                    <li>Juvenile delinquency: This is also called as youth crime. It is the crime committed by an individual
                        under the age of 18years.</li>

                    <li>Organized crimes: Organized crimes are defined as acts which are committed by two or more criminals
                        as a joint venture in an organized manner. These crimes involve kidnapping, dacoities, marketing of
                        illegal or prohibited goods, money laundering, trafficking people, buying votes, etc.</li>

                    <li>Personal crimes: Personal crimes are those crimes which target an individual person. These include
                        murder, assault, sexual assault, etc.</li>

                    <li>Property crimes: Property crimes are those crimes in which the target is a materialistic property.
                    </li>

                    <li>Sexual assault: Sexual assault involves rape.</li>

                    <li>Terrorism: Violence against the normal people living in the society.</li>

                    <li>Theft: Illegally taking away one’s property without force and without the notice of the owner.
                        Example: Pick pocketing, Shoplifting, Stealing bicycles, etc.</li>

                    <li>Vandalism: Damaging public or private property without permission is referred to as vandalism.</li>

                    <li>Victimless crimes: These are acts against moral values of an individual. Commissions of crime like
                        prostitution, illegal gambling, illegal drug use, etc. are examples of victimless crimes. Since
                        these crimes do not have an identifiable victim, they are called victimless crimes.</li>

                    <li>Violation of public safety: The violations of laws which threaten public safety are included under
                        violation of public safety.</li>

                    <li>White-collar crimes: Crimes committed by individuals belonging to high society. The crimes are
                        committed to a large extent in their work place.</li>
                </ol>

            </div>
        </div>
    </div>
@endsection
