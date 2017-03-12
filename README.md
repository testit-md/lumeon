## Lumeon Technical Test


### Overview

Thank you for your interest, the aim of this technical task is to gauge your understanding and approach to writing code. The test aims to mimic the the kind of code that you may comes across at Lumeon, which is a combination of modern Symfony code along with legacy code. Please do note that this is not an exact copy of the Lumeon environment.

We are looking for:

- Clean concise code
- Unit tests
- Testable programming techniques
- Understanding of existing code

### Test Instructions

The aim of the test is not to get you to concrete out existing repository classes to a specific DB/ORM, so please do not feel the need to add in SQL queries or other DB calls. Wireframe calls are acceptable for these purposes as long as it is made clear what the expected return is e.g.:
```
/** @return Entity */
public function selectById(){}
```

#### Question
Please answer the following question textually.

The file web/showhospitalpatients.php is intended to retrieve a list of patients for a given hospital and return that in json format. Are there any comments you would like to make? What could be improved about the code ?

> app[_dev].php are the entry points to the app, it means that all the traffic is routed to these files (depending on the env) and the logic required to render a response must be defined in controllers (@see http://symfony.com/doc/current/controller.html).

> It would be great the refactoring to include validation via Validator Component (@see http://symfony.com/doc/current/validation.html)

> There are 2 queries done for retrieving the result that could be optimized to use one Join query.

> There might be a lot of patients out there hence the result should be paginated

> The `msg` should be ready for i18n, so it have to be used Translation Component (@see http://symfony.com/doc/current/translation.html)

#### Exercise

This is the coding portion of the test. Please write code as well as you can using existing entities/repositories where appropriate and adding classes/files where needed.

Please add a new endpoint which allows us to save a patient against a doctor, bearing in mind that a doctor can have multiple patients.
- The output should be JSON.
- We should receive the doctor and the patients associated with that doctor in the output.
- Return any messages in the 'msg' key as per the existing code. 

We are looking for:

- Best practice in coding
- Unit test(s)
- The code to be hosted via git (e.g. github.com has free accounts)

### Your code should target

- PHP 5.6
- Symfony 2.8

### Final Words
Thank you very much for considering Lumeon, we aim to look at all entries as soon as possible but due to business needs we would like to apologise for any delay in advance. Good luck!