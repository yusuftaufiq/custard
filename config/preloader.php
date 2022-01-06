<?php
/**
 * Preloader Script 2.x
 *
 * This file is generated automatically by the Preloader package.
 *
 * The following script uses `opcache_compile_file($file)` syntax to preload each file in this list into Opcache.
 * To full enable preload, add this file to your `php.ini` in `opcache.preload` key to preload
 * this list of files PHP at startup. This file also includes some information about Opcache.
 *
 *
 * Add (or update) this line in `php.ini`:
 *
 *     opcache.preload=/var/www/html/devcode_todo/config/preloader.php
 *
 *
 * --- Config ---
 * Generated at: 2022-01-06 03:39:48 UTC
 * Opcache
 *     - Used Memory: 13.2 MB
 *     - Free Memory: 114.8 MB
 *     - Wasted Memory: 0.0 MB
 *     - Cached files: 211
 *     - Hit rate: 97.92%
 *     - Misses: 211
 * Preloader config
 *     - Memory limit: 32 MB
 *     - Overwrite: true
 *     - Files excluded: 0
 *     - Files appended: 0
 *
 *
 * For more information:
 * @see https://github.com/darkghosthunter/preloader
 */



$files = [
    '/var/www/html/devcode_todo/app/Listeners/Handler.php',
    '/var/www/html/devcode_todo/core/Framework.php',
    '/var/www/html/devcode_todo/routes/api.php',
    '/var/www/html/devcode_todo/vendor/autoload.php',
    '/var/www/html/devcode_todo/vendor/cakephp/core/functions.php',
    '/var/www/html/devcode_todo/vendor/cakephp/utility/Inflector.php',
    '/var/www/html/devcode_todo/vendor/cakephp/utility/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/composer/ClassLoader.php',
    '/var/www/html/devcode_todo/vendor/composer/autoload_real.php',
    '/var/www/html/devcode_todo/vendor/composer/autoload_static.php',
    '/var/www/html/devcode_todo/vendor/composer/platform_check.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/ConditionsScript.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/GeneratesScript.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/ManagesFiles.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/Opcache.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/Preloader.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/PreloaderCompiler.php',
    '/var/www/html/devcode_todo/vendor/darkghosthunter/preloader/src/PreloaderLister.php',
    '/var/www/html/devcode_todo/vendor/psr/event-dispatcher/src/EventDispatcherInterface.php',
    '/var/www/html/devcode_todo/vendor/psr/event-dispatcher/src/StoppableEventInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/deprecation-contracts/function.php',
    '/var/www/html/devcode_todo/vendor/symfony/event-dispatcher-contracts/Event.php',
    '/var/www/html/devcode_todo/vendor/symfony/event-dispatcher-contracts/EventDispatcherInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/event-dispatcher/EventDispatcher.php',
    '/var/www/html/devcode_todo/vendor/symfony/event-dispatcher/EventDispatcherInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/event-dispatcher/EventSubscriberInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/AcceptHeader.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/AcceptHeaderItem.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/FileBag.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/HeaderBag.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/HeaderUtils.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/InputBag.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/ParameterBag.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/Request.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/RequestStack.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/Response.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/ResponseHeaderBag.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/ServerBag.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolver/DefaultValueResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolver/RequestAttributeValueResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolver/RequestValueResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolver/SessionValueResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolver/VariadicValueResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentResolverInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ArgumentValueResolverInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ControllerResolver.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Controller/ControllerResolverInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactory.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactoryInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/ControllerArgumentsEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/ControllerEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/ExceptionEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/FinishRequestEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/KernelEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/RequestEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/ResponseEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/TerminateEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Event/ViewEvent.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/EventListener/ErrorListener.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/EventListener/RouterListener.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/HttpCache/HttpCache.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/HttpCache/Store.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/HttpCache/StoreInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/HttpKernel.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/HttpKernelInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/KernelEvents.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/TerminableInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-ctype/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-ctype/bootstrap80.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-intl-grapheme/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-intl-normalizer/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-intl-normalizer/bootstrap80.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-mbstring/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-mbstring/bootstrap80.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-php73/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-php80/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/polyfill-php81/bootstrap.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/CompiledRoute.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/CompiledUrlMatcher.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/Dumper/CompiledUrlMatcherDumper.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/Dumper/CompiledUrlMatcherTrait.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/Dumper/MatcherDumper.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/Dumper/MatcherDumperInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/Dumper/StaticPrefixCollection.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/RequestMatcherInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/UrlMatcher.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Matcher/UrlMatcherInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/RequestContext.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/RequestContextAwareInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/Route.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/RouteCollection.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/RouteCompiler.php',
    '/var/www/html/devcode_todo/vendor/symfony/routing/RouteCompilerInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/string/Resources/functions.php',
    '/var/www/html/devcode_todo/vendor/symfony/var-dumper/Resources/functions/dump.php',
    '/var/www/html/devcode_todo/web/index.php',
    '/var/www/html/devcode_todo/app/Events/Handler.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/IpUtils.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-foundation/JsonResponse.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadata.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/HttpCache/SubRequestHandler.php',
    '/var/www/html/devcode_todo/core/Database/Configuration.php',
    '/var/www/html/devcode_todo/core/Database/Connections/ConnectionInterface.php',
    '/var/www/html/devcode_todo/core/Database/Connections/MysqlConnection.php',
    '/var/www/html/devcode_todo/core/Database/Repositories/AbstractQueryBuilderRepository.php',
    '/var/www/html/devcode_todo/core/Database/Repositories/RepositoryInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Connection.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Driver.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Driver/Mysql.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Driver/SqlDialectTrait.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/DriverInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypeConverterTrait.php',
    '/var/www/html/devcode_todo/vendor/cakephp/datasource/ConnectionInterface.php',
    '/var/www/html/devcode_todo/vendor/psr/log/Psr/Log/LoggerAwareInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/core/Retry/CommandRetry.php',
    '/var/www/html/devcode_todo/vendor/cakephp/core/Retry/RetryStrategyInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/ExpressionInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Query.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/QueryCompiler.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Retry/ErrorCodeWaitStrategy.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Retry/ReconnectStrategy.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Statement/BufferResultsTrait.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Statement/MysqlStatement.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Statement/PDOStatement.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Statement/StatementDecorator.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/StatementInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypeMap.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypeMapTrait.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/ValueBinder.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Type/BaseType.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Type/ExpressionTypeCasterTrait.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Type/OptionalConvertInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Type/StringType.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypeFactory.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypeInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/QueryExpression.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/ComparisonExpression.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/FieldInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/FieldTrait.php',
    '/var/www/html/devcode_todo/app/Http/Controllers/TodoListController.php',
    '/var/www/html/devcode_todo/app/Models/TodoList.php',
    '/var/www/html/devcode_todo/vendor/symfony/translation-contracts/LocaleAwareInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/translation-contracts/TranslatorInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/translation-contracts/TranslatorTrait.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraint.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintValidatorFactory.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintValidatorFactoryInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintValidatorInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintViolationList.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintViolationListInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Collection.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/CollectionValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Composite.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Existence.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/NotBlank.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/NotNull.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Optional.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Context/ExecutionContext.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Context/ExecutionContextFactory.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Context/ExecutionContextFactoryInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Context/ExecutionContextInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/AutoMappingStrategy.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/CascadingStrategy.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/Factory/LazyLoadingMetadataFactory.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/Factory/MetadataFactoryInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/GenericMetadata.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/MetadataInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Mapping/TraversalStrategy.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Util/PropertyPath.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Validation.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Validator/ContextualValidatorInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Validator/RecursiveContextualValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Validator/RecursiveValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Validator/ValidatorInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ValidatorBuilder.php',
    '/var/www/html/devcode_todo/app/Http/Controllers/ActivityController.php',
    '/var/www/html/devcode_todo/app/Http/Controllers/ErrorController.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/AggregateExpression.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/FunctionExpression.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/WindowInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/FunctionsBuilder.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypedResultInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/TypedResultTrait.php',
    '/var/www/html/devcode_todo/vendor/symfony/error-handler/Exception/FlattenException.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Exception/HttpException.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Exception/HttpExceptionInterface.php',
    '/var/www/html/devcode_todo/app/Models/Activity.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/NotBlankValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/NotNullValidator.php',
    '/var/www/html/devcode_todo/app/Validators/TodoListValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Exception/NotFoundHttpException.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/AbstractComparison.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Choice.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/GreaterThan.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Positive.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/ZeroComparisonConstraintTrait.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Required.php',
    '/var/www/html/devcode_todo/app/Validators/ActivityValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/Email.php',
    '/var/www/html/devcode_todo/vendor/symfony/http-kernel/Exception/BadRequestHttpException.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintViolation.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/ConstraintViolationInterface.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Violation/ConstraintViolationBuilder.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Violation/ConstraintViolationBuilderInterface.php',
    '/var/www/html/devcode_todo/vendor/cakephp/database/Expression/ValuesExpression.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/AbstractComparisonValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/ChoiceValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/EmailValidator.php',
    '/var/www/html/devcode_todo/vendor/symfony/validator/Constraints/GreaterThanValidator.php'
];

foreach ($files as $file) {
    try {
        if (!(is_file($file) && is_readable($file))) {
            throw new \Exception("{$file} does not exist or is unreadable.");
        }
        opcache_compile_file($file);
    } catch (\Throwable $e) {
        echo 'Preloader Script has stopped with an error:' . \PHP_EOL;
        echo 'Message: ' . $e->getMessage() . \PHP_EOL;
        echo 'File: ' . $file . \PHP_EOL;

        throw $e;
    }
}

