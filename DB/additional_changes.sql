--
-- Table structure for table `fc_blogs`
--

CREATE TABLE `fc_blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `filter_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `fc_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `fc_filters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `map_filter` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `filter_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Indexes for table `fc_blogs`
--
ALTER TABLE `fc_blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fc_blogs_filter_id_foreign` (`filter_id`);

--
-- Indexes for table `fc_comments`
--
ALTER TABLE `fc_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fc_comments_blog_id_foreign` (`blog_id`),
  ADD KEY `fc_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `fc_filters`
--
ALTER TABLE `fc_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_filter`
--
ALTER TABLE `map_filter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `map_filter_blog_id_foreign` (`blog_id`),
  ADD KEY `map_filter_filter_id_foreign` (`filter_id`);

--
-- AUTO_INCREMENT for table `fc_blogs`
--
ALTER TABLE `fc_blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `fc_comments`
--
ALTER TABLE `fc_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `fc_filters`
--
ALTER TABLE `fc_filters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `map_filter`
--
ALTER TABLE `map_filter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


--
-- Constraints for table `fc_blogs`
--
ALTER TABLE `fc_blogs`
  ADD CONSTRAINT `fc_blogs_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `fc_filters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `map_filter`
--
ALTER TABLE `map_filter`
  ADD CONSTRAINT `map_filter_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `fc_blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `map_filter_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `fc_filters` (`id`) ON DELETE CASCADE;